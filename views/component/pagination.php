

<nav aria-label="Page navigation  row ">
    <ul class="pagination col-12">

        <?php
            $currentPage = $_GET['page'] ?? 1;
            $totalOfPage = count($customers['links'] );
            $disabledPrevious ='';
            if($currentPage == 1){
                $disabledPrevious = 'pointer-events: none;';
            }
        ?>
        <li class="page-item">
            <a class="page-link" style="<?=$disabledPrevious?>" href="<?=$_SERVER['PHP_SELF'].'?page='.($currentPage-1)?>" aria-label="Previous" >
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <a class="btn pr-1">Pagina <?=$currentPage?> de </a>
        <a class="btn pl-0"><?=$totalOfPage?></a>
        <?php
            $nextPage = $currentPage+1;

            if($nextPage > $totalOfPage){
                $nextPage = $totalOfPage;
            }
            $disabled = '';
            if($totalOfPage == $currentPage){
                $disabled = 'pointer-events: none;';
            }
        ?>
        <li class="page-item">
            <a class="page-link disabled-link" style="<?=$disabled?>" href="<?=$_SERVER['PHP_SELF'].'?page='.$nextPage?>" aria-label="Next" >
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
