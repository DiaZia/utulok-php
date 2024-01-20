<?php
/** @var \App\Core\LinkGenerator $link */
?>

<main>
    <div class="information col-sm-12 col-md-12" id="animatedText">
        <strong>Možnosti podpory<br><br></strong>
        <ul>
            <li>Finančná podpora<br>Bankový prevod:<br>
                IBAN: SK12 3400 0000 0012 3456 7890<br>
                SWIFT: TATRSKBX<br>
                Číslo účtu: 1234567890/1100 Tatra banka<br><br>
             </li>
            <li>Virtuálna adopcia zvieratka (pravidelné prispievanie).<br> <a href="<?= $link->url("pet.index") ?>">Naše zvieratká</a><br><br></li>
            <li>Darovanie krmiva, hračiek a iných pomôcok priamo u nás v útulku.<br><br></li>
            <li>Kúpa produktu z nášho <a href="<?= $link->url("home.eshop")?>" >e-shopu.</a><br><br></li>
            <li>Pravidelné venčenie našich psíkov.</li>
        </ul>
    </div>
</main>