[![PHP >= 7.0](https://img.shields.io/badge/PHP-%3E%3D7.0-8892bf.svg)](https://php.net)
[![Join the chat at https://gitter.im/icehawk/installer](https://badges.gitter.im/icehawk/installer.svg)](https://gitter.im/icehawk/installer?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

![IceHawk Framework](https://icehawk.github.io/images/Logo-Flying-Tail-White.png)

# IceHawk\Installer

Installs a new [IceHawk](https://github.com/icehawk/icehawk) skeleton project by using `composer create-project`.

You can optionally choose to install one ore more of the IceHawk components:

- [icehawk/session](https://github.com/icehawk/session)
- [icehawk/forms](https://github.com/icehawk/forms)
- [icehawk/pubsub](https://github.com/icehawk/pubsub)

## Usage

Run command:

```bash
composer create-project icehawk/installer /path/to/new-project -n
```

You will be asked questions regarding your desired installation.

**Please note:** For reasons of automation the installer initially installs some thrid-party dependencies. 
These will be removed at the end of the installation process.

## Quick installation check

Start the php built-in webserver:

```bash
cd /path/to/new-project/public
php -S 127.0.0.1:8088
```

Visit in your browser: http://127.0.0.1:8088/

**Please note:** You need to replace `127.0.0.1` with your machine's IP address, if you're not on your local host.

You should see a welcome page.

## Contributing

Contributions are welcome! Please see our [Contribution guide](./CONTRIBUTING.md).
