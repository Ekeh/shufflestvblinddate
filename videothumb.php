<?php

$frame = 3;
$movie = 'https://campoutnaija.com/dashboard/campout9ja_api/videos/316.mp4';
$thumbnail = 'thumbnail.png';

class VideoTile
{
    public static function createMovieThumb($srcFile, $destFile = "thumbnail.png")
    {
        // Change the path according to your server.
        $ffmpeg_path = '/usr/bin/';

        $output = array();

        $cmd = sprintf('%sffmpeg -i %s -an -ss 00:00:05 -r 1 -vframes 1 -y %s', 
            $ffmpeg_path, $srcFile, $destFile);

        if (strtoupper(substr(PHP_OS, 0, 3) == 'WIN'))
            $cmd = str_replace('/', DIRECTORY_SEPARATOR, $cmd);
        else
            $cmd = str_replace('\\', DIRECTORY_SEPARATOR, $cmd);

        exec($cmd, $output, $retval);

        if ($retval){
            print_r($retval);
            return 'false';
        }

        return $destFile;
    }
}

//thumb path should be added in the below code
            //test for thumb
            $dir_img='uploads/';
            /*
            $mediapath='123.jpg';
            $file_thumb=create_movie_thumb($dir_img.$mediapath,$mediapath,$mediaid);

            $name_file=explode(".",$mediapath);
            $imgname="thumb_".$name_file[0].".jpg";     
*/
            /*
              Function to create video thumbnail using ffmpeg
            */
            function create_movie_thumb($src_file,$mediapath)
            {
                global $CONFIG, $ERROR;

                $CONFIG['ffmpeg_path'] = '/usr/bin/ffmpeg/'; // Change the path according to your server.
                $dir_img='uploads/';
                $CONFIG['fullpath'] = $dir_img."thumbs/";

                //$src_file = $src_file;
                $name_file=explode(".",$mediapath);
                $imgname="thumb_".$name_file[0].".jpg";
                $dest_file = $CONFIG['fullpath'].$imgname;

                if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
                    // get the basedir, remove '/include'
                    $cur_dir = substr(dirname(__FILE__), 0, -8);
                    $src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
                    $ff_dest_file = '"' . $cur_dir . '\\' . strtr($dest_file, '/', '\\') . '"';
                } else {
                    $src_file = escapeshellarg($src_file);
                    $ff_dest_file = escapeshellarg($dest_file);
                }

                $output = array();

                if (eregi("win",$_ENV['OS'])) {
                    // Command to create video thumb
                    $cmd = "\"".str_replace("\\","/", $CONFIG['ffmpeg_path'])."ffmpeg\" -i ".str_replace("\\","/" ,$src_file )." -an -ss 00:00:05 -r 1 -vframes 1 -y ".str_replace("\\","/" ,$ff_dest_file);
                    exec ("\"$cmd\"", $output, $retval);

                } else {
                    // Command to create video thumb
                    $cmd = "{$CONFIG['ffmpeg_path']}ffmpeg -i $src_file -an -ss 00:00:05 -r 1 -vframes 1 -y $ff_dest_file";
                    exec ($cmd, $output, $retval);

                }


                if ($retval) {
                    $ERROR = "Error executing FFmpeg - Return value: $retval";
                    if ($CONFIG['debug_mode']) {
                        // Re-execute the command with the backtick operator in order to get all outputs
                        // will not work if safe mode is enabled
                        $output = `$cmd 2>&1`;
                        $ERROR .= "<br /><br /><div align=\"left\">Cmd line : <br /><span style=\"font-size:120%\">" . nl2br(htmlspecialchars($cmd)) . "</span></div>";
                        $ERROR .= "<br /><br /><div align=\"left\">The ffmpeg program said:<br /><span style=\"font-size:120%\">";
                        $ERROR .= nl2br(htmlspecialchars($output));
                        $ERROR .= "</span></div>";
                    }
                    @unlink($dest_file);
                    return false;
                }

                $return = $dest_file;
                //@chmod($return, octdec($CONFIG['default_file_mode'])); //silence the output in case chmod is disabled
                return $return;
            }


$file = VideoTile::createMovieThumb($movie);
echo $file;

//$file_thumb=create_movie_thumb($movie,$thumbnail);
//echo $file_thumb;

//$ffmpegPath = exec('which ffmpeg');
//echo $ffmpegPath;

?>