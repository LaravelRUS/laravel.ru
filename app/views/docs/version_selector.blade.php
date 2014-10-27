<ul class="nav navbar-nav version_selector_menu" >
        <li>
            <span>Версия фреймворка:</span>
        </li>
        <?foreach($all_versions as $version){?>
        <li <?if($version == $current_version){?>class="active"<?}?> >
            <a href="<?= route("docs",[$version, $name]) ?>"><?= $version ?></a>
        </li>
        <?}?>
    </ul><!--//nav version selector -->
