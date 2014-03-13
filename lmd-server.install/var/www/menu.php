<?php
  
  header ( "Content-type: text/plain" );
  
  
function check_sanity($nbd_name,$nbd_id){
	// Check if nbd_name is according to its nbd_id, exists conf file and img.

	//echo "Checking: $nbd_name with $nbd_id";

	$nbd_conf_dir="/etc/nbd-server/conf.d/";
	$nbd_conf_prefix="ltsp_";
	$nbd_conf_ext=".conf";
	$lines=file($nbd_conf_dir.$nbd_conf_prefix.$nbd_name.$nbd_conf_ext);

	if (substr($lines[0], 0, -1)=="[".$nbd_id."]") {
		$i=1;
		do{
			list($attribute, $value)=split( "=" ,$lines[$i]);
			if (trim($attribute)=="exportname"){
				// Exist this exportname img?
    				if (is_file(trim($value))) return true;
			}
			$i++;
		} while ($i<count($lines));
	}

	// If we are here... bad luck...
	return false;
	
}


function getName($dir){
	// Check if exists /etc/ltsp/images/$dir and gets image name
	try{
		$string = file_get_contents("/etc/ltsp/images/".$dir.".json");	
		$json=json_decode($string,true);
		return $json["name"];
	} catch (Exception $e) {
		return $dir;
	}
}

?>
  
MENU TITLE Arrencada per xarxa de LliureX
MENU BACKGROUND pxe/lliurex-pxe.png

MENU WIDTH 80
MENU MARGIN 10
MENU ROWS 12
MENU TABMSGROW 18
MENU CMDLINEROW 12
MENU ENDROW 24
MENU TIMEOUTROW 20
menu color title  1;36;44   #ff8bc2ff #00000000 std
menu color unsel  37;44     #ff1069c5 #00000000 std
menu color sel    7;37;40   #ff000000 #ffff7518 all
menu color hotkey 1;37;44   #ffffffff #00000000 std
menu color hotsel 1;7;37;40 #ff000431 #ffff7518 all
menu color border 0 #00ffffff #00ffffff none
TIMEOUT 50


<?
$path="/var/lib/tftpboot/ltsp/";
$dir_desc = opendir($path);
$base_dir="/opt/ltsp/";

while ($dir = readdir($dir_desc))
{
    if (is_file($path.$dir."/pxelinux.cfg/default")&&($dir!=".")&&($dir!="..")){


	//echo "dir is $dir and default is a file\n";

	$lines = file($path.$dir."/pxelinux.cfg/default");
	foreach ($lines as $line_num => $line) {

            // getting vmlinuz
	    //echo "getting vmlinuz with line $line\n";
	    if ((strpos($line,'vmlinuz') !== false)&&(strpos($line,'kernel') !== false)){
                $kernel=trim(str_replace("kernel", "", $line ));
		$kernel_line="kernel pxe/$dir/$kernel\n";
	    }
	    	    
 	    if (strpos($line,'nbdroot') !== false){
		if (check_sanity($dir, $base_dir.$dir)){
			
			// Append Line:
			$append_line=$line;

			// Getting ip for next-server:
			$server=str_replace("'","",$_GET['next-server']);

			// Setting nbd_id
			$nbd_id=$base_dir.$dir;
			
			$append_line=str_replace("{server}",$server,$append_line);
			$append_line=str_replace("{nbd_id}",$nbd_id,$append_line);
			$append_line=str_replace("initrd=","initrd=/pxe/$dir/",$append_line);

			// Getting Name for label
			$name=getName($dir); // Gets the name of $dir
			
			echo "label $dir\n";
			echo "menu label $name\n";
			echo "$kernel_line";
			echo "$append_line";
			echo "ipappend 3\n\n";
			
			
		}
	      }

	}
		
	}
}




  
  /*
  title ( "Secure Network Boot" );
  
  if ( ! authenticated() ) {
    retry();
  } else {
  
    if ( $username == "mcb30" ) {
  
      sanboot ( "MS-DOS 6.22",
                "iscsi:chipmunk.tuntap::::iqn.2007-07.chipmunk:msdos622" );
  
      sanboot ( "Windows 2k3",
                "iscsi:chipmunk.tuntap::::iqn.2007-07.chipmunk:win2k3" );
  
    }
  
    uriboot ( "Linux rescue shell",
              "http://chipmunk.tuntap/images/uniboot/uniboot.php", "" );
  }
  
  LABEL iso
 MENU iso
 MENU LABEL Boot iso
 KERNEL memdisk
 INITRD isos/lliurex-lleuger_1306.iso
 APPEND iso raw
  */
  
  
  ?>
  
LABEL iso
 MENU iso
 MENU LABEL Boot mini iso
 KERNEL memdisk
 APPEND iso ro initrd=isos/mini.iso
