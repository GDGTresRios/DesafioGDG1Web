<?php

/**
 * Classe de tratamento de imagem para gravação
 * Data: 11/05/2008
 * Leonardo L Procópio
 */
class TImagem {

    private $foto;
    private $config;
    private $erro;
    private $nome_foto;
    private $codigo_imagem;
    private $localizacaoFoto; //caminho e nome da foto

    /**
     * Função que verifica a integridade da imagem
     * @param $foto = armazena a foto;
     */

    public function verifica_imagem($foto, $tamanho, $largura, $nomeArquivo = "") {
        $this->config['tamanho'] = 3786000; //Tamanho máximo do arquivo (em bytes)
        $this->config['largura'] = 1024;    //Largura máximo do arquivo (em px)
        $this->config['altura']  = 768;     //Altura máximo do arquivo (em px)

        if ($foto) {
            //verifica o mime-type do arquivo é de imagem
            if (!preg_match('/pjpeg|jpeg|png/', $foto['type'])) { //preg_match('/pjpeg|jpeg|png|gif|bmp/ 
                $this->erro = 'Arquivo em formato inválido! A foto deve ser jpg,jpeg ou png. Envie outra foto!';
            } else {
                //verifica o tamanho da foto
                if ($foto['size'] > $this->config['tamanho']) {
                    $this->erro[] = 'Arquivo em tamanho muito grande! 
                                             A foto deve ser no máximo ' . $this->config['tamanho'] . ' bytes, e essa é de ' . $foto['size'] . '
                                             Envie uma foto menor!';
                }
            }

            //Imprime as mensagens de erro
            if (sizeof($this->erro)) {
                foreach ($this->erro as $err) {
                    $erro .= ' * ' . $err . '<br />';
                }
                $erro = 'Erro na hora de carregar a foto!<br />' . $erro;
                return $erro;
            } else {
                //Verificação de dados OK, nenhum erro ocorrido, executa então o upload	
                //Pega a extensão do arquivo
                preg_match('/\.(jpg|jpeg|png){1}$/i', $foto['name'], $ext); //preg_match('/\.(gif|bmp|png|jpg|jpeg){1}$/i', $foto['name'], $ext );
                //@todo Esquema que fiz pro nome da imagem, dá uma olhada

                if (empty($nomeArquivo)) {
                    //Gera um nome único para a Imagem
                    $imagem_nome = md5(uniqid(time())) . '.' . $ext[1];
                } else {
                    $imagem_nome = $nomeArquivo . '.' . $ext[1];
                }

                $this->nome_foto = $imagem_nome;

                //Caminho de onde a imagem ficará
                $this->localizacaoFoto = '../tmp/' . $imagem_nome;

                //Faz o upload da imagem
                copy($foto['tmp_name'], $this->localizacaoFoto);

                //redimensionando
                $this->load($this->localizacaoFoto);
                $this->resize($tamanho, $largura);
                $this->save($this->localizacaoFoto);

                //Pegando o codigo da imagem
                $this->codigo_imagem = 'data:image/' . $ext[1] . ';base64,' . base64_encode(file_get_contents($this->localizacaoFoto));
                $this->excluirImagem();
                return FALSE;
            }
        }
    }

    /**
     * função que retorna o nome da imagem
     * @param string $nome_foto = nome novo da foto;
     */
    public function get_nome_foto() {
        return $this->nome_foto;
    }

    /**
     * função que retorna o codigo da imagem
     * @param string $codigo_imagem = codigo da imagem
     */
    public function get_caminho_foto() {
        return $this->localizacaoFoto;
    }

    public function getCodigoImagem() {
        return $this->codigo_imagem;
    }

    /**
     * função exlclui a imagem
     * @param string $codigo_imagem = codigo da imagem
     */
    public function excluirImagem() {
        if (file_exists($this->localizacaoFoto)) {
            unlink($this->localizacaoFoto);
        }
    }

    /*
     * File: SimpleImage.php
     * Author: Simon Jarvis
     * Copyright: 2006 Simon Jarvis
     * Date: 08/11/06
     * Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
     * 
     * This program is free software; you can redistribute it and/or 
     * modify it under the terms of the GNU General Public License 
     * as published by the Free Software Foundation; either version 2 
     * of the License, or (at your option) any later version.
     * 
     * This program is distributed in the hope that it will be useful, 
     * but WITHOUT ANY WARRANTY; without even the implied warranty of 
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
     * GNU General Public License for more details: 
     * http://www.gnu.org/licenses/gpl.html
     */

    var $image;
    var $image_type;

    public function load($filename) {
        $image_info       = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }

    function getWidth() {
        return imagesx($this->image);
    }

    function getHeight() {
        return imagesy($this->image);
    }

    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio  = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale) {
        $width  = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height) {
        $new_image   = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    /*
      The first example below will load a file named picture.jpg resize it to 250 pixels wide and 400 pixels high and resave it as picture2.jpg
      <?php
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load('picture.jpg');
      $image->resize(250,400);
      $image->save('picture2.jpg');
      ?>

      If you want to resize to a specifed width but keep the dimensions ratio the same then the script can work out the required height for you, just use the resizeToWidth function.

      <?php
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load('picture.jpg');
      $image->resizeToWidth(250);
      $image->save('picture2.jpg');
      ?>

      You may wish to scale an image to a specified percentage like the following which will resize the image to 50% of its original width and height

      <?php
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load('picture.jpg');
      $image->scale(50);
      $image->save('picture2.jpg');
      ?>

      You can of course do more than one thing at once. The following example will create two new images with heights of 200 pixels and 500 pixels

      <?php
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load('picture.jpg');
      $image->resizeToHeight(500);
      $image->save('picture2.jpg');
      $image->resizeToHeight(200);
      $image->save('picture3.jpg');
      ?>

      The output function lets you output the image straight to the browser without having to save the file. Its useful for on the fly thumbnail generation

      <?php
      header('Content-Type: image/jpeg');
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load('picture.jpg');
      $image->resizeToWidth(150);
      $image->output();
      ?>

      The following example will resize and save an image which has been uploaded via a form

      <?php
      if( isset($_POST['submit']) ) {
      include('SimpleImage.php');
      $image = new SimpleImage();
      $image->load($_FILES['uploaded_image']['tmp_name']);
      $image->resizeToWidth(150);
      $image->output();
      } else {
      ?>

      <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="uploaded_image" />
      <input type="submit" name="submit" value="Upload" />
      </form>

      <?php
      }
      ?>
     */
}

?>