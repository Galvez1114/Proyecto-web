<?php
    /****************************************
     *   CREACION DE LA IMAGEN DEL CAPTCHA  *
     * **************************************/
    /**************************************************** 
     * En el archivo php.ini debe estar habilitado:     *
     *    extension=gd                                  *
     *    gd.jpeg_ignore_warning = 1                    *
     * https://www.youtube.com/watch?v=GuqK_vHata0      *           
     ****************************************************/
    //Activa las sesiones
    session_start();

    $valor_aleatorio = md5(rand());                 //Genera un valor aleatorio
    $valor_captcha = substr($valor_aleatorio, 0, 6);//Obtiene 6 caracteres del valor aleatorio

    //Guarda el valor generado como variable de sesion para despues poder verificarlo 
    $_SESSION['valor_captcha_generado'] = $valor_captcha;

    //Crea un imagen rectangular de 200 x 38
    $imagen = imagecreate(200, 38);
    //$imagen = imagecreatetruecolor(200, 38);

    //Elegimos el color del fondo de la imagen
    $color_fondo = imagecolorallocate($imagen, 231, 100, 18);

    //Elegimos el color del texto de la imagen
    $color_texto = imagecolorallocate($imagen, 255, 255, 255);

    //Cargamos el tipo de letra (se pueden descargar de https://www.freefontspro.com/ )
    $font = dirname(__FILE__) . '/res/arial.ttf';

    //Rellenamos la imagen con el color de fondo
    imagefill($imagen, 0, 0, $color_fondo);

    //Colocamos el texto y caracteristicas del texto en la imagen
    imagettftext($imagen, 20, 0, 60, 28, $color_texto, $font, $valor_captcha);


    //Genera la imagen
    header('Content-Type: image/png');
    imagepng($imagen);

    imagedestroy($imagen);


/************************************************************************************
 * NOTAS:                                                                           *
 * md5 ( string $str) : string                                                      *
 *    Calcula el hash MD5 de str utilizando el Algoritmo MD5                        *
 *    (Message-Digest de RSA Data Security, Inc.) y devuelve ese hash.              *
 *                                                                                  *
 * imagecolorallocate ( recurso $image , int $red , int $green , int $blue ) : int  *
 *    Devuelve un identificador de color que representa el color compuesto por los  *
 *    componentes RGB especificados.                                                *
 *                                                                                  *
 * imagecreatetruecolor ( int $width , int $height ) : recurso                      *
 *   imagecreatetruecolor() devuelve un identificador de imagen que representa una  * 
 *   imagen negra del tamaño especificado.                                          *
 *                                                                                  *
 * bool imagefill( $image, $x, $y, $color )                                        *
 *    relleno una imagen con un color dado a partir de la coordenada indicada       *
 *     (la parte superior izquierda es 0, 0)                                        *
 *                                                                                  *
 * imagettftext ( resource $image, float $size, float $angle, int $x, int $y,       *
 *                 int $color , string $fontfile , string $text ) : array           *
 *      Escribe el texto text dado en una imagen usando fuentes                     *
 *                                                                                  *
 * bool imagepng( resource $image)                                                  *
 *      Muestra la imagen al navegador (Manda la imagen al navefgador).             *                               *
 *                                                                                  *
 * imagedestroy ( recurso $image ) : bool                                           *
 *      Libera cualquier memoria asociada con la imagen                             *
 * **********************************************************************************/
?>