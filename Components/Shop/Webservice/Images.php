<?php

namespace Components\Shop\Webservice;

use Framework\CMS\Webservice\Response,
    Framework\System\Session\Session,
    Framework\System\Data as Data,
    Framework\CMS as CMS;
use Components\Shop\Model\Product;
use Components\Shop\Model\Page;
use Components\Shop\Model\ProductImage;

/**
 * @uri /shop/images
 */
class Albums extends CMS\Webservice\Rest
{
    /**
     * @method POST
     * @priority 10
     * @provides application/json
     * @json
     * @return \Framework\CMS\Webservice\Response
     */
    public function uploadImage()
    {
        $user = CMS\User::get();
        /*if ($user->isGuest()) {
            return new Response(200, null);
        }*/

        $result = [];
        $uploads_dir = '/uploads';

        if ($_FILES["file1"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["file1"]["tmp_name"];
            $name = $_FILES["file1"]["name"];
            $uploadName = CMS\Bazalt::uploadFilename($name, 'shop');
            if (move_uploaded_file($tmp_name, $uploadName)) {
                $image = ProductImage::create();
                $image->url = relativePath($uploadName);
                $image->save();

                $result = $image;
            }
        } else {
            switch ($_FILES["file1"]["error"]) {
                case UPLOAD_ERR_INI_SIZE:
                    $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = "The uploaded file was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = "Missing a temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = "File upload stopped by extension";
                    break;

                default:
                    $message = "Unknown upload error";
                    break;
            }
            $result['file1']['error'] = $message;
        }
        return new Response(200, $result);
    }

    /**
     * @method PUT
     * @priority 10
     * @param  int $album_id
     * @provides application/json
     * @json
     * @return \Framework\CMS\Webservice\Response
     */
    public function updateOrders($album_id)
    {
        $data = (array)$this->request->data;
        $album = Album::getById($album_id);

        $count = $album->Photos->count();
        $orders = [];
        foreach ($data['orders'] as $order => $id) {
            $pos = $count - $order;
            $orders[$id] = $pos;
            Photo::updatePhotoOrder($id, $pos);
        }
        return new Response(200, $orders);
    }

    /**
     * @method DELETE
     * @priority 10
     * @param  int $album_id
     * @param  int $photo_id
     * @provides application/json
     * @json
     * @return \Framework\CMS\Webservice\Response
     */
    public function deletePhoto($album_id, $photo_id)
    {
        $user = CMS\User::get();
        $album = Product::getById($album_id);
        $photo = ProductImage::getById($photo_id);
        /*if ($user->isGuest()) {
            return new Response(200, null);
        }*/
        $album->count_img--;
        $album->save();
        $photo->delete();
        return new Response(200, true);
    }
}
