

<?php
/*

  Template Name: Marie Miller

 */

get_header();
global $options;

foreach ($options as $value) {

    if (get_option($value['id']) === FALSE) {
        $$value['id'] = $value['std'];
    } else {
        $$value['id'] = get_option($value['id']);
    }
}
?>

<!-- Main content alpha -->

<div class="main png_bg">
    <div class="inner_main">

        <?php
        $ds_alpha = stripslashes(get_post_meta($post->ID, "ds_alpha", true));
        if (!empty($ds_alpha)) {
            echo '<div class="container_alpha slogan">' . $ds_alpha . '</div>';
        }
        ?>

        <?php if ($ds_eth_breadcrumbs_navi == 'Yes') { ?>

            <div class="container_gamma breadcrumbs">

                <?php ds_breadcrumb_nav(); ?>

            </div>

        <?php } ?>

        <div class="container_omega">
            <div class="event">
                <div class="left">
                    <div class="title">

                        <span class="title1">CONFÉRENCE</span>
                        <span class="title2">POUR</span>
                        <span class="title3">elle</span>
                        <div class="title4-wrapper">
                            <span class="title4">LIBÉRÉ DE LA<br /><span class="violence">VIOLENCE</span></span>
                        </div>
                    </div>
                    <div class="reverend">
                        <div class="desciption">
                            <div class="name">
                                <ul>
                                    <li>RÉVÉREND</li>
                                    <li>MARIE MILLER</li>
                                    <li>ÉVANGÉLISTE INTERNATIONALE</li>
                                </ul>
                            </div>

                            <p>
                                Rev Miller a commencé son ministère au sein de l'équipe pastorale de l'église pentecôtiste Agincourt, une grande assemblée multiculturelle de Toronto, en Ontario. Par la suite, elle a servi comme pasteure principale de la Bible Way Église pentecôtiste à Montréal, Québec. Elle se consacre maintenant à plein temps dans le ministère comme évangéliste itinérant et une coordonatrice des missions sous la bannière de "Foundations Ministries Inc."
                                <br />
                                <br />
                                L'amour de Marie Miller pour la Parole de Dieu lui permet de servir le Seigneur avec passion. Elle a pour objectif de voir la justice exaltée, pour mandat d'aider à l'édification du corps de Christ et au perfectionnement des saints, pour mission la conversion des âmes, pour moteur une passion pour la libération de la prochaine génération dans le Royaume de Dieu.
                            </p>

                        </div>
                        <div class="picture"></div>

                    </div>
                    <div class="block-video">
                            <iframe src="//player.vimeo.com/video/84873819?title=0&amp;byline=0&amp;portrait=0" width="400" height="225" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                    <div class="downloads">
                        <h2>TÉLÉCHARGEMENTS</h2>
                        <a href="http://www.gospelvie.com/wp-content/uploads/2014/02/Inscription_MarieMiller.pdf" target="_blank">1. Formulaire d'inscription</a>
                        <a href="http://www.gospelvie.com/wp-content/uploads/2014/01/MARIE_MILLER_FINALE.jpg" target="_blank">2. Affiche d'évènement</a> <br />
                        <a href="http://www.gospelvie.com/wp-content/uploads/2014/01/Programme-de-la-Conférence-pour-elle.pdf" target="_blank">3. Dépliant d'évènement</a>
                    </div>
                </div>
                <div class="right">
                    <div class="box-info informations">
                        <h2>INFORMATIONS</h2>
                        <ul>
                            <li>Date: <strong>7 au 8 mars 2014</strong></li>
                            <li class="lieu">
                                Lieu: <strong>Église Gospelvie</strong><br />
                                <span class="station">(Montréal, Station Papineau)</span>
                            </li>
                            <li>Coût: <strong>40$ / personne</strong></li>
                            <li>Date limite: <strong>21 février 2014</strong></li>
                        </ul>
                        <p class="info">
                            *POUR LES DEUX JOUNÉES<br />
                            NON REMBOURSABLE 
                        </p>
                    </div>
                    <div class="box-info paiement">
                        <h2>PAIEMENT</h2>
                        <ul>
                            <li>
                                <strong>1. Chèque</strong>
                                <p>
                                    Envoyer votre chèque au nom de l'Église <br />Gospelvie
                                    à l'adresse postale ci-dessous.<br />
                                    Inclure le <a href="http://www.gospelvie.com/wp-content/uploads/2014/02/Inscription_MarieMiller.pdf" target="_blank" class="download-link">formulaire d'inscription</a> dans l'enveloppe.

                                </p>
                            </li>
                            <li>
                                <strong>2. Paiement en ligne PAYPAL</strong>
                                <p>
                                    Il est possible de payer en ligne de façon<br />
                                    sécuritaire.
                                </p>
                            </li>
                        </ul>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ED56DESSXZ332">
<input type="image" src="http://www.gospelvie.com/wp-content/uploads/2014/01/button.png" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
<input type="hidden" name="undefined_quantity" value="1">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_CA/i/scr/pixel.gif" width="1" height="1">
</form>

                    </div>
                    <div class="box-info horaire">
                        <h2>HORAIRE</h2>
                        <ul>
                            <li>
                                <strong>Vendredi 7 mars</strong>
                                <ul>
                                    <li>Inscriptions/Bienvenue: 18h</li>
                                    <li>Session 1: 19h</li>
                                </ul>
                            </li>
                            <li>
                                <strong>Vendredi 8 mars</strong>
                                <ul>
                                    <li>Ouverture des portes: 8h30</li>
                                    <li>Session 2: 10h</li>
                                    <li>Diner: 12h</li>
                                    <li>Partage de témoignages: 14h</li>
                                    <li>Session 3: 16h</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="box-info adresse">
                        <h2>ADRESSE</h2>
                        <p>
                            <span>ÉGLISE GOSPELVIE</span><br />
                            1455 AV PAPINEAU<br />
                            MONTRÉAL, QC H2K 4H5<br />
                            INFO@GOSPELVIE.COM<br />
                            514-522-8781
                        </p>
                        <p class="stationnement">
                            STATION PAPINEAU / STATIONNEMENT DISPONIBLE TVA
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- /True containers (keep the content inside containers!) -->

</div>

<div class="endmain png_bg"></div>

<!-- /Main content alpha -->



<!-- //Main Content Sector ends// -->

<?php get_footer(); ?>