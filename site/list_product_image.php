<div class="dd" id="nestable">
   <!-- Liste öğeleri burada olacak -->
   <?php 

   $query=$db->prepare("SELECT * FROM product_image WHERE p_id=1");
    $query->execute();
    $returnUser = $query->fetchAll(PDO::FETCH_ASSOC);

   foreach ($returnUser as $value) 
   {
      ?>
      <img src="<?php echo apath; ?>template/image/<?php echo $value['i_path'];?>" alt="">
      <?php  
   }

    ?>
</div>

<?php


function renderMenuItem($id, $label, $url)
{
    return '<li class="dd-item dd3-item" data-id="' . $id . '" data-label="' . $label . '" data-url="' . $url . '">' .
        '<div class="dd-handle dd3-handle" > Drag</div>' .
        '<div class="dd3-content"><span>' . $label . '</span>' .
        '<div class="item-edit">Edit</div>' .
        '</div>' .
        '<div class="item-settings d-none">' .
        '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' . $label . '"></label></p>' .
        '<p><label for="">Navigation Url<br><input type="text" name="navigation_url" value="' . $url . '"></label></p>' .
        '<p><a class="item-delete" href="javascript:;">Remove</a> |' .
        '<a class="item-close" href="javascript:;">Close</a></p>' .
        '</div>';

}

function menuTree($parent_id = 0)
{
   $p_id=1;
    global $db;
    $items = '';
    $query = $db->query("SELECT * FROM product_image WHERE p_id=$p_id");
    if ($query->rowCount() > 0) {
        $items .= '<ol class="dd-list">';
        $result = $query->fetchAll();
        foreach ($result as $row) {
            $items .= renderMenuItem($row['PA_ID'], $row['PA_NAME'], $row['PA_URL']);
            $items .= menuTree($row['PA_ID']);
            $items .= '</li>';
        }
        $items .= '</ol>';
    }
    return $items;
}

?>




    <form id="add-item">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="url" placeholder="Url">
        <button type="submit">Add Item</button>
    </form>

    <hr />

    <div class="dd" id="nestable">
        <?php
            $html_menu = menuTree();
            echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
        ?>
    </div>


    <hr />
    <form action="menu.php" method="post">
        <input type="hidden" id="nestable-output" name="menu">
        <button type="submit">Save Menu</button>
    </form>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.nestable.js"></script>
    <script src="js/script.js"></script>
