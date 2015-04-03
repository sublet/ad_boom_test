AdBoom Test
=================

Preferred Editor: Sublime Text 2 (http://www.sublimetext.com/2)

We run a PHP based setup, with Mongo and MySQL databases.  MySQL is used for data logging.

Everything has been setup using Vagrant, so it should be a very easy install. (http://www.vagrantup.com/) 

<h2>Install Virtual Box</h2>

VirtualBox is a general-purpose full virtualizer for x86 hardware, targeted at server, desktop and embedded use.  Just download the installer for your platform.

https://www.virtualbox.org/wiki/Downloads

<h2>Install Vagrant</h2>

Always use the most recent Vagrant build.  We have tested it up to 1.3.5.  Download and install.

http://downloads.vagrantup.com/

<h2>Install the LTP Repository</h2>

In terminal run the following:

~~~~~{bash}
cd ~
mkdir code
cd code
git clone git@github.com:sublet/ad_boom_test.git
~~~~~

<h2>Launch Vagrant Box</h2>

To launch the server just go into the directory and type "vagrant up".  This process can take a while so while this is going on feel free to continue on.

In terminal run the following:

~~~~~{bash}
cd ~/code/ad_boom_test/
vagrant up
~~~~~