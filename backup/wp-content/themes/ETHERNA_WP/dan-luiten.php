<?php
/*

  Template Name: Dan Luiten

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
            <section>
                <table id="table1_DanLuiten">
                    <tr>
                            <!--<td id="titleBox">CONFÉRENCE DE <br/><span class="praise">LOUANGE</span><br/> <span class="artists">AVEC <span class="nom">DAN LUITEN</span> ET <span class="nom">JÉRÉMIE POULET</span></span></td>-->
                        <td id="aPropos_DanLuiten">
                            <h2>À PROPOS</h2>
                            <div id="aPropos_Content_DanLuiten">
                                <p>
                                    Tu aimes louer et adorer Dieu? Cette méga-conférence de louange est pour toi! Durant trois jours, deux orateurs expérimentés te proposeront des outils pour aller plus loin dans le ministère de louange et t'ouvrir à de nouveaux défis.
                                </p>
                                <p>
                                    Dan Luiten, en collaboration avec Jérémie Poulet, offre des séminaires de formation à travers le monde, destinés aux personnes appelées à servir Dieu et l'Église francophone par leur don musical, vocal ou technique. 
                                </p>
                                <p>
                                    Tu cherches à approfondir tes connaissances sur la louange et l'adoration? Tu brûles d'envie de répondre aux besoins de ton église? Ne manque surtout pas cet évènement (qui sera clôturé par un concert de louange et d'adoration).
                                </p>
                            </div>
                        </td>

                        <td>
                            <div id="infos_DanLuiten">
                                <h2>INFORMATIONS</h2>
                                <br />
                                <br />
                                <span>
                                    <em class="datePlaceCost_DanLuiten">Date</em> : <br />
                                    <strong>Conférence</strong> - Jeudi 28 au samedi 30 août<br/>
                                    <strong>Concert de louange</strong> - Dimanche 31 août <br />à partir de 18h30
                                    <br/><br/>
                                    <em class="datePlaceCost_DanLuiten">Lieu</em> : <br />Église Gospelvie, Montréal<br/>
                                    (Station Papineau)
                                    <br/><br/>
                                    <em class="datePlaceCost_DanLuiten">Coût</em> :<br/>
                                    <strong>CONFÉRENCE, AVANT LE 24 AOÛT</strong><br/>
                                    45 $ / personne (groupe de 10 et +)<br/>
                                    50 $ / personne
                                    <br/><br/>
                                    <strong>CONFÉRENCE, APRÈS LE 24 AOÛT</strong><br/>
                                    55 $ / personne (groupe de 10 et +)<br/>
                                    65 $ / personne
                                    <br/><br/>
                                    <strong>CONFÉRENCE, JOURNÉE DU 30 AOÛT</strong><br/>
                                    35 $ / personne
                                    <br/>
                                    <span id="fineprint">* toute la journée du samedi 30 août</span>
                                    <br/>
                                    <br/>
                                    <strong>CONCERT DE LOUANGE</strong><br/>
                                    10 $ / personne (sur place)
                                    <br />

                                    <span id="fineprint">* veuillez contactez l'Église Gospelvie pour plus d'info à<br /> propos des billets du concert</span>
                                </span>
                            </div>
                            <br/>
                            <div id="inscriptions_DanLuiten">
                                <h2>INSCRIPTIONS/PAIEMENTS</h2><!--Ce titre n'est ici que pour eviter de creer trop de classes-->
                                <ol>
                                    <li>
                                        <span class="header">Chèque</span> <br />
                                        <span class="instructions_DanLuiten">Envoyer votre chèque au nom de l'Église
                                            Gospelvie à  l'adresse postale ci-dessous.
                                            Inclure formulaire d'inscription dans l'enveloppe.
                                        </span>

                                    </li>
<li>
<span class="header">PAYMENT À L'ENTRER</span> <br />
                                        <span class="instructions_DanLuiten">Vous pouvez payer directement sur place à l'entrer de l'église Gospelvie.
                                        </span>
</li>

<?php /* ?>
                                    <li>
                                        <span class="header">PAYPAL EN LIGNE</span> <br />
                                        <span class="instructions_DanLuiten">Il est possible de payer en ligne de façon
                                            sécuritaire.
                                            <br />
                                            <br />
                                            <span class="payment">

                                                <form method="POST" action="/wp-content/themes/ETHERNA_WP/dan.php?t=d&p=1" target="_blank">
                                                    <label>Choissisez le type de billet: </label>
                                                    <br />
                                                    <input type="radio" name="type" value="type1" onchange="changeQt('1');" checked="checked" />Concert de louange (10$)
                                              
                                                    <hr style="maring: 0px;" />
                                                   
                                                    <input type="radio" name="type" value="type2" onchange="changeQt('1');" />Conférence de louange (50$)
                                                    <br />
                                                    <input type="radio" name="type" value="type3" onchange="changeQt('10');" />Conférence de louange - Groupe 10 et + (45$) 
                                                    <br />
                                                    <input type="radio" name="type" value="type4" onchange="changeQt('1');" />Conférence de louange - Journée du samedi 30 août (35$) 
                                                    <br />
                                                    <input type="checkbox" name="cl" value="cl" />+ Concert de louange (10$) 
                                                    <hr style="maring: 0px;" />
                                                    <hr style="maring: 0px;" />
                                                    <label>Nombres de billets: </label><input id="qt" type="number" min="1" value="1" name="quantity" style="width: 50px;" />
                                                    <br />
                                                    <br />

                                                    <input style="width: 159px;" type="image" src="http://www.gospelvie.com/wp-content/uploads/2014/01/button.png" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !" value="">
                                                </form>
                                            </span>
                                        </span>

                                    </li>
<?php */ ?>
                                </ol>
                                <br/>

                            </div>	
                        </td>
                    </tr>
                </table>
                <hr class="separator" />
                <table id="table2_DanLuiten">
                    <tr >
                        <td id="vCell_DanLuiten">
                            <h2 class="leftTextT2_DanLuiten">VIDÉO</h2>
                            <iframe src="//player.vimeo.com/video/97440530?title=0&amp;byline=0&amp;portrait=0" width="400" height="225" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                            <h2 class="leftTextT2_DanLuiten">TÉLÉCHARGEMENTS</h2>
                            <ol class="leftTextT2_DanLuiten">
                                <li><a href="http://www.gospelvie.com/wp-content/uploads/2014/06/Annonce_169.jpg" title="Affiche de la conférence en format 16:9" download >Affiche (16:9)</a></li>
                                <li><a href="http://www.gospelvie.com/wp-content/uploads/2014/06/Annonce_43.jpg" title="Affiche de la conférence en format 4:3" download >Affiche (4:3)</a></li>
                                <li><a href="http://www.gospelvie.com/wp-content/uploads/2014/06/Poster_11X17.jpg" title="Poster de la conférence" download >Poster</a></li>
                                <li><a href="http://www.gospelvie.com/wp-content/uploads/2014/06/DAN_LUITEN_INSCRIPTION.jpg" download >Formulaire d'inscription</a></li>
                            </ol>
                        </td>

                        <td id="schedule_DanLuiten">
                            <h2>HORAIRE</h2>
                            <span class="font-size">
                                <span class="date_DanLuiten">CONFÉRENCE</span>
                                <br/>
                                --------------------
                                <br/> 
                                <span class="date_DanLuiten">JEUDI 28 AOÛT</span><br/>
                                Inscription et ouverture des portes: 17h00<br/>
                                Atelier 1 - Théologie : 18h30<br/>
                                <br/>
                                <span class="date_DanLuiten">VENDREDI 29 AOÛT</span><br/>
                                Inscription et ouverture des portes: 17h30<br/>
                                Atelier 2 : 19h00<br/>
                                <br/>
                                <span class="date_DanLuiten">SAMEDI 30 AOÛT</span><br/>
                                Atelier 3 : 9h00<br/>
                                Diner : 12h00<br/>
                                Groupes (musiciens/choristes) : 13h30<br/>
                                Atelier 4 : 14h45<br/>
                                <br/>
                                <br/>
                                <span class="date_DanLuiten">CONCERT DE LOUANGE</span>
                                <br/>
                                ------------------------------------
                                <br/> 
                                <span class="date_DanLuiten">DIMANCHE 31 AOÛT</span><br/>
                                Concert de louange : 18h30<br/>
                                <br/>
                                <h2>ADRESSE</h2>
                                ÉGLISE GOSPELVIE<br/>
                                1455 AV PAPINEAU<br/>
                                MONTRÉAL, QC H2K 4H5<br/>
                                INFO@GOSPELVIE.COM<br/>
                                514-522-8781
                                <br />
                                <span class="stationnement">
                                    STATION PAPINEAU / STATIONNEMENT DISPONIBLE TVA
                                </span>
                            </span>
                        </td>
                    </tr>

                </table>
            </section>
        </div>

    </div>
    <!-- /True containers (keep the content inside containers!) -->

</div>

<div class="endmain png_bg"></div>

<!-- /Main content alpha -->



<!-- //Main Content Sector ends// -->

<?php get_footer(); ?>

<script type="text/javascript">
                                                        function changeQt(qt) {
                                                            $("#qt").val(qt);
                                                            $("#qt").attr('min', qt);
                                                        }
</script>