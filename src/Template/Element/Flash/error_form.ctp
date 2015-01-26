<div class="alert alert-danger" role="alert">
    Errors:
    <ul>
    <?
        foreach($message as $n){
            echo "<li>".h($n)."</li>";
        }

       ?>
    </ul>
</div>
