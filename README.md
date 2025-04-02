# Rustdesk-Proxmox-VM

Install instructions for Rustdesk Server in a Debian 12 VM

I used the Proxmox helper script to install a Debian 12 VM<br>
https://community-scripts.github.io/ProxmoxVE/scripts?id=debian-vm

From there I used the these instructions to install and configure the Rustdesk Server<br>
No Docker!

Both hbbr and hbbs are run with the -k <key> parameter to only allow clients with the same key to connect<br>
I needed to add the -r <server_ip> to the hbbs to get clients to connect faster without having to force them to use the relay

I have also included two php scripts to monitor the clients connected to the server.

These scripts read and write to the sqlite3 DB that Rustdesk maintains in <br>
/var/lib/rustdesk-server/db_v2.sqlite3

It only shows the clients but can't tell if they are online or not.<br>
The status field is always null<br>
I added a button to add notes to each client

You will need to change permissions to allow write access to the DB<br>
chown root:www-data /var/lib/rustdesk-server/db_v2*<br>
chmod 664 /var/lib/rustdesk-server/db_v2<br>
