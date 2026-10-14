<?php
/**
 * Poem Summary – Aufräumen bei der Deinstallation
 * Version: 1.0 (14.10.2026)
 * Änderung: Erstversion – löscht Einstellungen und zwischengespeicherte Gedichte.
 *
 * Idee und Entwicklung: meiersworld.de – https://www.meiersworld.de
 * Die Freigabe-Markierungen an den Artikeln (Meta-Feld mw_psm_enabled) bleiben bewusst erhalten.
 */

if (!defined('WP_UNINSTALL_PLUGIN')) { exit; }

delete_option('mw_psm_options');

global $wpdb;
$like_a = $wpdb->esc_like('_transient_mw_psm_') . '%';
$like_b = $wpdb->esc_like('_transient_timeout_mw_psm_') . '%';
$wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s", $like_a, $like_b));
