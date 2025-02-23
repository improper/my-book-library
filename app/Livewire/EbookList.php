<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use SebLucas\EPubMeta\EPub;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Laravel\Facades\Image;


class EbookList extends Component
{
    public $ebooks = [];

    public function mount()
    {
        // Find all EPUB files in the 'books' directory
        $files = Storage::disk('public')->allFiles('books');

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'epub') {
                // Get metadata from the EPUB file
                $this->ebooks[] = $this->getEbookMetadata($file);
            }
        }
    }

    private function getEbookMetadata($file)
    {
        $path = storage_path('app/public/' . $file);

        // Use Mike42's EPUBMeta to read the EPUB file
        try {
            $epub = new EPub($path);
        } catch (Exception $e) {
            Log::error("Invalid epub file: {$path}");
            return [
                'title' => 'File not found',
                'author' => 'Unknown Author',
                'publisher' => 'Unknown Publisher',
                'file_path' => $file,
                'cover' => '',
                'available' => false
            ];
        }

        // Get the cover image content
        $coverImageData = $epub->getCover();

        // Check if the cover image exists
        if ($coverImageData) {
            // Generate a unique filename for the cover image
            $fileName = 'epub_cover_' . md5($file) . '.jpg';  // Or use any other format based on the image type

            // Resize the image to 100px width
            $image = Image::read($coverImageData)->scale(100);

            // Save the resized image to storage (public disk)
            $image->save(storage_path('app/public/' . $fileName));

            // Get the public URL to the image
            $coverUrl = Storage::url($fileName);
        } else {
            // If no cover image is available, set coverUrl to null
            $coverUrl = '';
        }

        // Return the relevant metadata, including the cover URL
        return [
            'title' => $epub->getTitle() ?? 'Unknown Title',
            'author' => implode(', ', $epub->getAuthors()) ?? 'Unknown Author',
            'publisher' => $epub->getPublisher() ?? 'Unknown Publisher',
            'file_path' => $file,
            'cover' => $coverUrl,
            'available' => true
        ];
    }

    public function render()
    {
        return view('livewire.ebook-list', ['ebooks' => $this->ebooks]);
    }
}
