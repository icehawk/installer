![IceHawk Framework](https://icehawk.github.io/images/Logo-Flying-Tail-White.png)

# IceHawk Installer

Installs new IceHawk projects by using `composer create-project`

## Usage

Run command:

```bash
composer create-project icehawk/installer /path/to/new-project
```

You will be asked questions regarding your desired installation.

**Please note:** For reasons of automation the installer initially installs some thrid-party dependencies. These will be removed at the end of the installation process.

## Quick installation check

Start the php built-in webserver:

```bash
cd /path/to/new-project/public
php -S 127.0.0.1:8088
```

Visit in your browser: http://127.0.0.1:8088/

**Please note:** You need to replace `127.0.0.1` with your machine's IP address, if you're not on your local host.

You should see a welcome page.
