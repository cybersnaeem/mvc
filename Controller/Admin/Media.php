<?php

namespace Controller\Admin;



class Media extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {

        $gridBlock = \Mage::getBlock("block\admin\customerGroup\grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            if (isset($_FILES['image'])) {
                $errors = array();
                $file_name = $_FILES['image']['name'];

                $file_tmp = $_FILES['image']['tmp_name'];
                

                $tmp = explode('.', $file_name);

                $file_ext = strtolower(end($tmp));

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                $dir = './Media/Images/Product/'.$this->getRequest()->getGet('id');

                if (!file_exists($dir) && !is_dir($dir)) {
                    mkdir($dir);
                }

                if (empty($errors) == true) {
                    if (move_uploaded_file($file_tmp, "{$dir}/" . $file_name)) {
                        $productId = $this->getRequest()->getGet('id');
                        $product = \Mage::getModel("Model\Media");
                        $product->productId = $productId;
                        $product->imageName = $file_name;
                        if ($product->save()) {
                            $this->getMessage()->setSuccess("Image Uploaded Successfully !!");
                        }
                    }
                    echo "Success";
                } else {
                    print_r($errors);
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailed($e->getMessage());
        }
      
        $this->redirect('form', 'admin\product', null, false);
    }

    public function checkAction()
    {
        try {

            if (!$this->getRequest()->getGet('id')) {
                $this->redirect('grid', 'product', null, true);
            }

            $imageData = $this->getRequest()->getPost('image');

            if(!$imageData){
                throw new \Exception("No Product Found To Update Or Delete !!", 1);
            }

            $small = "";
            $thumb = "";
            $base = "";

            if (array_key_exists('small', $imageData)) {
                $small = $imageData['small'];
                unset($imageData['small']);
            }
            if (array_key_exists('thumb', $imageData)) {
                $thumb = $imageData['thumb'];
                unset($imageData['thumb']);
            }
            if (array_key_exists('base', $imageData)) {
                $base = $imageData['base'];
                unset($imageData['base']);
            }

            if (array_key_exists('update', $this->getRequest()->getPost())) {

                foreach ($imageData as $key => $value) {

                    if (array_key_exists('remove', $value)) {
                        unset($value['remove']);
                    }

                    if ($key == $small) {
                        $value['small'] = 1;
                    }

                    if ($key == $base) {
                        $value['base'] = 1;
                    }

                    if ($key == $thumb) {
                        $value['thumb'] = 1;
                    }


                    if (!array_key_exists('base', $value)) {
                        $value['base'] = 0;
                    }
                    if (!array_key_exists('small', $value)) {
                        $value['small'] = 0;
                    }
                    if (!array_key_exists('thumb', $value)) {
                        $value['thumb'] = 0;
                    }


                    if (!array_key_exists('gallery', $value)) {
                        $value['gallery'] = 0;
                    } else {
                        $value['gallery'] = 1;
                    }

                    unset($value['imageType']);

                    $values = array_values($value);
                    $fields = array_keys($value);
                    $final = null;

                    for ($i = 0; $i < count($fields); $i++) {
                        if ($fields[$i] == $key) {
                            $id = $values[$i];
                            continue;
                        }
                        $final = $final . "`" . $fields[$i] . "`='" . $values[$i] . "',";
                    }
                    $final = rtrim($final, ",");

                    $query = "UPDATE `productgallery` SET {$final} WHERE `productGalleryId` = '{$key}'";

                    $upModel = \Mage::getModel('model\media');
                    if ($upModel->update($query)) {
                        $this->getMessage()->setSuccess("Update Changes Successfully !!");
                    }
                }
            } else {
                $keys = [];
                foreach ($imageData as $key => $value) {
                    if (array_key_exists('remove', $value)) {
                        $delModel = \Mage::getModel('model\media');
                        $keys[] = $key;
                    }

                }
                $Media = \Mage::getModel('model\media');
                echo $query = "SELECT imageName from productgallery  where productGalleryId IN (" . implode(',', $keys) . ")";

                $filenames = $Media->fetchAll($query);
                

                $dir = './Media/Images/Product/'.$this->getRequest()->getGet('id');

                foreach ($filenames->getData() as $key => $value) {
                    
                    unlink("{$dir}/{$value->imageName}");
                }


                $query = "delete from productgallery  where productGalleryId IN (" . implode(',', $keys) . ")";
            
                
                if ($delModel->delete($query)) {
                    $this->getMessage()->setSuccess("Product Images Delete For Product !!");
                } else {
                    $this->getMessage()->setSuccess("Unable To Delete Product Image !!");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\product', null, false);
    }
}
