# What is My Book Library

**My Book Library**, a near zero-config app that helps you list and download your ePub book collection. It displays information extracted from your books' meta data such as cover art, title, and the author.

# How do I run My Book Library

You can run **My Book Library** with minimal configuration using Docker.

## Prerequisites

-   Docker
-   Docker Compose

## Getting Started

1. Copy the `docker-compose.yml` from the root directory of this repository.
2. Books access
   * Ensure this line points to the location of your ePubs on your host machine: `- ./books:/app/storage/app/public/books`

### Optional Steps

1. Set the environment variables `HOST_UID` and `HOST_GID` to match your current user.
2. Logs access
   * If you wish to access logs from the host, update the host mapping for logs: `- ./logs:/app/storage/logs`
   * Otherwise, you may remove this line: `- ./logs:/app/storage/logs`
3. Port mapping
   * If you wish to change your host port, update `- "3000:3000"` to use your preferred host port.
  
The end result may look something like:

```yaml
services:
  my-book-library:
    image: improper/my-book-library:latest
    container_name: my-book-library
    restart: unless-stopped
    # user: "${HOST_UID}:${HOST_GID}" # Match to your user
    ports:
      - "3000:3000"
    volumes:
    #  - ./logs:/app/storage/logs
      - ./books:/app/storage/app/public/books
```

### Start the service

With those few adjustments, launch the service with `docker-compose up -d`. Your app will be available at http://127.0.0.1:3000 or the port that you specified.

# Can I load my books onto my e-reader?

## Kobo
Yes, some versions of Kobo have an internet browser that will enable you to download your owned ebooks to your device.

1. From your Kobo device navigate to *More > Beta Features*
2. In the Web Browser section, tap "Start"
3. Visit the URL of your app using your LAN IP (commonly `http://192.168.1.{?}:3000`). You'll need to determine your LAN IP.
4. Tap "Get" to download the book to your Kobo.

> [!TIP] Tap the `...` icon to set *My Book Library* website as your Kobo browser homepage.

## Kindle & other devices

Please feel free to try a process similar to the Kobo and report your findings here.
