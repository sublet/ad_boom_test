AdBoom Test
=================

Preferred Editor: Sublime Text 2 (http://www.sublimetext.com/2)

Everything has been setup using Vagrant, so it should be a very easy install. (http://www.vagrantup.com/) 

<h2>Install Virtual Box</h2>

VirtualBox is a general-purpose full virtualizer for x86 hardware, targeted at server, desktop and embedded use.  Just download the installer for your platform.

https://www.virtualbox.org/wiki/Downloads

<h2>Install Vagrant</h2>

Download and install.

http://downloads.vagrantup.com/

<h2>Install the Repo</h2>

In terminal run the following:

~~~~~{bash}
cd ~
mkdir code
cd code
git clone git@github.com:sublet/ad_boom_test.git
~~~~~

<h2>Launch Vagrant Box</h2>

To launch the server just go into the directory and type "vagrant up".  This process can take a while so while.

In terminal run the following:

~~~~~{bash}
cd ~/code/ad_boom_test/
vagrant up
~~~~~

Once completed you should be able to view in your browser at

~~~~~{bash}
http://localhost:8080/
~~~~~
