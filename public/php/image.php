<?php
class Image
{
    public $width = 0; // php加上this預設就為0,因此可不填寫
    public $height = 0; // php加上this預設就為0,因此可不填寫
    public $url = null;
    public $data = null;
    public $origin = null;
    public $thumb = null;
    public $css_object_fit = 'fill';
    private $x;
    private $y;

    // getimagesizefromstring($str)
    function __construct($data)
    {
        $this->data = $data;
        list($this->width, $this->height) = getimagesizefromstring($data); // 傳回陣列 一長一寬
        // var_dump($this->width, $this->height);
    }

    function resize($x, $y, $mode)
    {
        $this->x = $x;
        $this->y = $y;
        $ratio = $this->width / $this->height;
        switch ($mode) {
            case 'fill':
                $this->css_object_fit = 'fill';
                $newwidth = $x;
                $newheight = $y;
                break;

            case 'aspectfill':
                $this->css_object_fit = 'cover';
                if ($y > $x) {
                    $newwidth = $x;
                    $newheight = (int)($newwidth / $ratio);
                } else {
                    $newheight = $y;
                    $newwidth = (int)($newheight * $ratio);
                }
                break;

            case 'aspectfit':
                $this->css_object_fit = 'contain';
                if ($y > $x) {
                    $newheight = $y;
                    $newwidth = (int)($newheight * $ratio);
                } else {
                    $newwidth = $x;
                    $newheight = (int)($newwidth / $ratio);
                }
                break;
        }

        $gc = imagecreatetruecolor($newwidth, $newheight);
        $origin = imagecreatefromstring($this->data);
        // $origin = imagecreatefromjpeg($this->url);

        imagecopyresized(
            $gc,
            $origin,
            0,
            0,
            0,
            0,
            $newwidth,
            $newheight,
            $this->width,
            $this->height
        );

        ob_start();
        imagejpeg($gc);
        $this->thumb = ob_get_contents();
        ob_end_clean();

        ob_start();
        imagejpeg($origin);
        $this->origin = ob_get_contents();
        ob_end_clean();
    }

    function getImageSrc($type)
    {
        switch ($type) {
            case 'origin':
                $mime_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($this->origin);
                $base64 = base64_encode($this->origin);
                $src = "data:{$mime_type};base64,{$base64}";
                break;
            case 'thumb':
                $mime_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($this->thumb);
                $base64 = base64_encode($this->thumb);
                $src = "data:{$mime_type};base64,{$base64}";
                break;
        }
        return [$src, $this->x . 'px', $this->y . 'px', $this->css_object_fit];
    }
}

// 寬>高
$data = file_get_contents('https://cdn.siasat.com/wp-content/uploads/2022/10/2022_10img25_Oct_2022_PTI10_25_2022_000199B-scaled.jpg');

// 正方形
// $data = file_get_contents('https://img.ixintu.com/upload/jpg/20210525/7deaa23e7b00cd850e02f67404f27b54_19159_800_800.jpg!con');

// 高>寬
// $data = file_get_contents('https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?cs=srgb&dl=pexels-mohamed-abdelghaffar-771742.jpg&fm=jpg');
$image = new Image($data);
// $image = new Image('https://i.ppfocus.com/2020/12/23214bdb6d9a.jpg');
$image->resize(400, 400, 'aspectfit'); // fill, aspectfill, aspectfit
list($src, $css_width, $css_height, $css_object_fit) = $image->getImageSrc('thumb');
?>