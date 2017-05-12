<?php
require_once('params.php');
$default_option="setkmap=fr scandelay=5 netboot=${url}linux_live/sysresccd/sysrcd.dat autoruns=2 ar_source=${url}linux_live/sysresccd/  ar_nowait";
echo "cpuid --ext 29 && set arch x86_64 || set arch x86\n";
echo "cpuid --ext 29 && set archb 64 || set archb 32\n";
echo "cpuid --ext 29 && set archl x86_64 || set archl i386\n";
echo "set rescue rescue\n";
echo ":menustart\n";
echo "menu iPXE System rescue Menu\n";
echo "item --gap --	Sauvegarde / Restauration / Repartitionnement \n";
echo "item default 	Resolution graphique minimum\n";
echo "item r800		Resolution graphique 800 x 600\n";
echo "item altker	Resolution graphique minimum et Noyau alternatif\n";
echo "item --gap\n";

echo "item --gap --	Mode clonage en automatique\n";
echo "item 	udp1	Emetteur UdpCast\n";
echo "item 	udp2	Recepteur UdpCast (poste ecrase)\n";
echo "item --gap\n";

echo "item retour Retour\n";

echo "choose selected && goto \${selected} || goto failed\n";

echo ":default\n";
echo "echo Booting \${cname}SystemRescueCD\${reset} (\${archb})\n";
echo "sleep 1\n";
echo "kernel {$url}linux_live/sysresccd/rescue\${archb} || goto failed\n";
echo "initrd {$url}linux_live/sysresccd/initrd.img || || goto failed\n";
echo "imgargs \${rescue}\${archb} $default_option || goto failed\n";
echo "boot\n";

echo ":r800\n";
echo "echo Booting \${cname}SystemRescueCD\${reset} (\${archb})\n";
echo "sleep 1\n";
echo "kernel {$url}linux_live/sysresccd/rescue\${archb} || goto failed\n";
echo "initrd {$url}linux_live/sysresccd/initrd.img || || goto failed\n";
echo "imgargs \${rescue}\${archb} vga=788 $default_option || goto failed\n";
echo "boot\n";

echo ":altker\n";
echo "set rescue altker\n";
echo "echo Booting \${cname}SystemRescueCD\${reset} (\${archb})\n";
echo "sleep 1\n";
echo "kernel {$url}linux_live/sysresccd/rescue\${archb} || goto failed\n";
echo "initrd {$url}linux_live/sysresccd/initrd.img || || goto failed\n";
echo "imgargs \${rescue}\${archb} $default_option || goto failed\n";
echo "boot\n";

echo ":udp1\n";
echo "echo Booting \${cname}SystemRescueCD\${reset} (\${archb})\n";
echo "sleep 1\n";
echo "kernel {$url}linux_live/sysresccd/rescue\${archb} || goto failed\n";
echo "initrd {$url}linux_live/sysresccd/initrd.img || || goto failed\n";
echo "imgargs \${rescue}\${archb} $default_option work=u1 docache dodhcp  || goto failed\n";
echo "boot\n";

echo ":udp2\n";
echo "echo Booting \${cname}SystemRescueCD\${reset} (\${archb})\n";
echo "sleep 1\n";
echo "kernel {$url}linux_live/sysresccd/rescue\${archb} || goto failed\n";
echo "initrd {$url}linux_live/sysresccd/initrd.img || || goto failed\n";
echo "imgargs \${rescue}\${archb} $default_option work=u2 docache dodhcp || goto failed\n";
echo "boot\n";

echo ":retour\n";
echo "chain --replace --autofree {$url}/boot.php\n";

echo ":failed\n";
echo "echo erreur - retour au menu!!\n";
echo "sleep 5\n";
echo "chain --replace --autofree {$url}/boot.php\n";
?>
