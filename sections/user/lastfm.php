<?
//Include Last.fm in the user sidebar only if a Last.fm username is specified.
$DB->query("SELECT username FROM lastfm_users WHERE ID = '$UserID'");
if ($DB->record_count()) {
    list($LastFMUsername) = $DB->next_record();
    $LastFMInfo = LastFM::get_user_info($LastFMUsername);
    //Hand everything else over to js (gets data via the username in an id-d div) to allow faster page loading.
    ?>
    <div class="box box_info box_lastfm">
        <div class="head colhead_dark">Last.fm</div>
        <ul class="stats nobullet">
            <li class="lastfm_username">
                Username: <a id="lastfm_username" href="<?= $LastFMInfo['user']['url'] ?>" title="<?= $LastFMInfo['user']['name'] ?> on Last.fm: <?= $LastFMInfo['user']['playcount'] ?> plays, <?= $LastFMInfo['user']['playlists'] ?> playlists."><?= $LastFMInfo['user']['name'] ?></a>
            </li>
            <div id="lastfm_stats" <? if ($OwnProfile == true): ?>data-uid="<?= $OwnProfile ?>"<? endif; ?>>
            </div>
            <li>
                [<a href="#" id="lastfm_expand" onclick="return false">Show more info</a>]
                <?
                //Append the reload stats button only if allowed on the current user page.
                $Response = $Cache->get_value('lastfm_clear_cache_' . $LoggedUser . '_' . $_GET['id']);
                if (empty($Response)) :
                ?>
                <span id="lastfm_reload_container">
                    [<a href="#" id="lastfm_reload" onclick="return false">Reload stats</a>]
                </span>
                <? endif; ?>
            </li>
        </ul>
    </div>

<? } ?>