VAGRANTFILE_API_VERSION = "2"

# composer install script
$script = <<SCRIPT
curl -sS 'https://getcomposer.org/installer' | php -- --install-dir=/usr/local/bin --filename=composer
chmod +x /usr/local/bin/composer
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # box-config
  config.vm.box = "devops007"
  config.vm.box_url = "http://box.3wolt.de/devops007/"
  config.vm.box_check_update = true
  config.vm.box_version = "~> 1.2.0"

  # network-config
  config.vm.network "public_network", type: "dhcp"
  config.vm.boot_timeout = 600

  #config.vm.provider "virtualbox" do |v|
  #    v.gui = true
  #end

  # SSH-config
  config.ssh.username = "root"
  config.ssh.insert_key = true

  # hostname
  config.vm.hostname = "IceHawkInstaller"

  config.vm.provision "shell", inline: $script

end
