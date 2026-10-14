<?php
/**
 * Plugin Name: Poem Summary
 * Plugin URI:  https://www.meiersworld.de
 * Description: Adds a "Read this article as a poem" box to your articles. Visitors pick a form (haiku, limerick, sonnet, rap and more), the AI provider of your choice (Claude, OpenAI, Mistral, Grok, Gemini or any OpenAI-compatible service) writes a short poem that sums up the article. Release per article in the editor. DE + EN. / Fügt Artikeln eine Box hinzu, die den Beitrag auf Knopfdruck als Gedicht zusammenfasst (Haiku, Elfchen, Limerick, Sonett, Rap u. a.). Freigabe pro Artikel im Editor.
 * Version:     1.1
 * Letzte Änderung: 14.10.2026
 * Änderung:    Hinweis zu eigenem API-Key und eigenen Kosten (README, Einstellungsseite). Davor 1.0 Erstfassung: Gedichtform-Auswahl für Besucher, wählbarer KI-Anbieter, Freigabe pro Artikel, Silben- und Wortprüfung mit einem Korrekturversuch, Zwischenspeicher, Limits, Verbindungstest.
 * Author:      meiersworld.de
 * Author URI:  https://www.meiersworld.de
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: poem-summary
 * Requires at least: 5.8
 * Requires PHP: 7.0
 *
 * Idee und Entwicklung: meiersworld.de – https://www.meiersworld.de
 * Copyright (C) 2026 meiersworld.de
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation; either version 2 of the
 * License, or (at your option) any later version. Please keep this credit notice intact.
 */

if (!defined('ABSPATH')) { exit; }

// Schutz: Läuft schon eine andere Kopie (z. B. als mu-plugin; sie definiert MW_PSM_VERSION),
// wird der Kern nicht geladen. So gibt es keinen Fatal Error durch doppelte Funktionen.
if (defined('MW_PSM_VERSION')) {
    add_action('admin_notices', 'mw_psm_conflict_notice');
    function mw_psm_conflict_notice() {
        echo '<div class="notice notice-warning"><p><strong>Poem Summary:</strong> Another copy of this tool is already active (e.g. in mu-plugins). / Eine andere Kopie dieses Tools ist bereits aktiv (z. B. in mu-plugins). Bitte nur eine Variante nutzen.</p></div>';
    }
    return;
}

define('MW_PSM_FILE', __FILE__);
require_once dirname(__FILE__) . '/poem-summary-core.php';
