<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <table class="table">
        <tbody>
            <tr>
                <td scope="row" colspan="2">
                    <?php echo  $this->getChild("Header")->toHtml(); ?>
                </td>
            </tr>
            <tr height="400px">
            <td scope="row" width="250px">
                <?php echo $this->getChild('Sidebar')->toHtml(); ?>
            </td>
            <td>
                <?php echo $this->createBlock('Block\Core\Layout\Message')->toHtml(); ?>
                <?php echo $this->getChild('Content')->toHtml();?>
            </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->getChild("Footer")->toHtml(); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>