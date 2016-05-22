<?php
/**
 * Created by Catalin Teodorescu on 22-May-16 00:26.
 */
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';

if (!empty($_GET['url']) && (filter_var($_GET['url'], FILTER_VALIDATE_URL) !== false)) {
    $metaElements = parser($_GET['url']);
} else {
    dump('Please provide a valid URL');
}
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<div class="container">
    <form method="GET" action="" class="form-inline text-center">
        <div class="form-group">
            <input type="text" name="url" placeholder="url" value="<?php echo !empty($_GET['url']) ? $_GET['url'] : ''; ?>" class="form-control"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php if (!empty($metaElements)) { ?>
        <table class="table table-responsive table-bordered table-condensed table-hover">
            <tr>
                <th>Tag</th>
                <th>Length</th>
                <th>Text</th>
            </tr>
            <?php
            foreach ($metaElements as $key => $value) {
                if ($key != 'content') { //nu generam un rand nou in tabel pentru content-ul paginii
                    ?>
                    <tr class="<?php echo empty($value) ? 'danger' : ''; ?>">
                        <td>
                            <b><?php echo ucfirst($key); ?></b><br>
                            <?php echo empty($value) ? ucfirst($key).' empty' : ''; ?>
                        </td>
                        <td>
                            <?php if (!empty($value)) {
                                $stats = stats($value, $metaElements['content']);
                                echo $stats;
                            } ?>
                        </td>
                        <td>
                            <?php if (!empty($value)) {
                                echo $value;
                            } ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    <?php } ?>
</div>
