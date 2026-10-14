# Poem Summary

Version: 1.1 (14.10.2026)
Änderung: Hinweis ergänzt, dass jeder Betreiber einen eigenen API-Key braucht und die Kosten über das eigene Konto beim KI-Anbieter laufen.
Vorherige Änderung (1.0, 14.10.2026): Erstfassung – Gedichtform-Auswahl für Besucher, wählbarer KI-Anbieter, Freigabe pro Artikel.

**Idee und Entwicklung: [meiersworld.de](https://www.meiersworld.de)** · Lizenz: GPL-2.0-or-later

---

## Deutsch

### Was das Plugin macht

Unter einem Artikel erscheint eine Box „Diesen Artikel als Gedicht lesen“. Besucher wählen eine Form (zum Beispiel Haiku, Elfchen, Limerick, Sonett oder Rap), ein Klick genügt, und ein KI-Modell deiner Wahl verdichtet den Artikel zu einem kurzen Gedicht. Unter dem Gedicht steht, dass es KI-generiert ist, mit Form, Modellname und Datum. Gedichte werden zwischengespeichert: Dieselbe Form zum selben Artikel-Stand kostet nur einmal.

Du entscheidest pro Artikel, ob die Box erscheint (Checkbox im Editor), denn nicht jeder Beitrag eignet sich für ein Gedicht.

### Formen

Deutsch: Haiku, Tanka, Elfchen, Limerick, Schüttelreim-Vierzeiler, Sonett, Ballade im Moritatenstil, Rap.
Englisch: Haiku, Tanka, Limerick, Sonnet, Ballad, Rap, Heroic Couplets.

Bei Haiku, Tanka und Elfchen zählt das Plugin Silben bzw. Wörter nach und lässt die KI einmal nachbessern. Die Silbenzählung ist eine Näherung (Fremdwörter wie „Cache“ zählt sie falsch), und KI-Modelle zählen Silben ohnehin unzuverlässig. Wer es exakt braucht, lässt Haiku und Tanka in den Einstellungen weg.

### Voraussetzungen

- WordPress 5.8 oder neuer, PHP 7.0 oder neuer
- Ein **eigener** API-Key eines KI-Anbieters: Anthropic (Claude), OpenAI, Mistral, xAI (Grok), Google Gemini, OpenRouter oder ein beliebiger OpenAI-kompatibler Dienst. Das Plugin enthält keinen Key und keine Gedicht-Flatrate: Die Kosten entstehen bei deinem Anbieter, über dein Konto.

### Installation

1. `poem-summary.zip` herunterladen.
2. In WordPress: **Plugins → Installieren → Plugin hochladen**, ZIP auswählen, **Jetzt installieren**, dann **Aktivieren**.
3. **Einstellungen → Poem Summary** öffnen, den KI-Anbieter wählen, API-Key (und außer bei Anthropic den Modellnamen) eintragen, die Inhaltstypen anhaken (z. B. „Beiträge“) und die Gedichtformen auswählen. Speichern. Mit **Verbindung testen** prüfst du die Anbindung.
4. Beitrag im Editor öffnen, in der Seitenleiste bei **Poem Summary** den Haken **Gedicht-Box freigeben** setzen, Beitrag aktualisieren. Fertig.

In der Beitragsliste zeigt die Spalte „Gedicht“, wo die Box freigegeben ist.

Alternativ zum Eintrag in den Einstellungen kann der Key als Konstante `MW_PSM_API_KEY` (bei Anthropic auch `ANTHROPIC_API_KEY`) in der `wp-config.php` stehen. Das ist sicherer, weil der Key dann nicht in der Datenbank liegt.

### Einstellungen

| Einstellung | Bedeutung |
| --- | --- |
| KI-Anbieter, API-Key, Modell | Welcher Anbieter dichtet. Bei Anthropic ist `claude-haiku-4-5-20251001` voreingestellt, bei allen anderen trägst du den Modellnamen selbst ein. Für bessere Reime und Pointen lohnt ein größeres Modell |
| Basis-URL | Nur bei „Eigener Anbieter“ |
| Inhaltstypen | Für welche Typen die Freigabe-Checkbox erscheint, mit Sprache je Typ (automatisch, Deutsch, English). Die Sprache bestimmt auch die Sprache des Gedichts |
| Gedichtformen | Welche Formen Besucher in der Auswahlliste sehen |
| Ton | Heiter, ernst, pathetisch oder trocken-ironisch |
| Standard | Ob Artikel ohne gesetzte Freigabe automatisch freigegeben sind (empfohlen: aus) |
| Limits | Gedichte pro IP und Stunde, neue KI-Gedichte pro Tag insgesamt |
| Cloudflare | Anhaken, wenn die Seite hinter Cloudflare liegt, sonst teilen sich alle Besucher ein Limit |
| Credit | Kleiner Hinweis „Idee: meiersworld.de“ in der Box |

Die Sprache der Box folgt standardmäßig der Websprache (mit Polylang der Artikelsprache). Per Filter `mw_psm_lang` lässt sie sich überschreiben.

### Anderen KI-Anbieter als Anthropic nutzen

1. Unter **Einstellungen → Poem Summary** den **KI-Anbieter** auswählen: OpenAI, Mistral AI, xAI (Grok), Google Gemini oder OpenRouter. Die Adresse der Schnittstelle ist bereits hinterlegt.
2. Den **API-Key** des Anbieters eintragen (im Konto des Anbieters erstellen).
3. Den **Modellnamen** eintragen, genau so, wie er in der Modellliste des Anbieters steht. Modellnamen ändern sich häufig, deshalb gibt es hier keine Voreinstellung.
4. Speichern und **Verbindung testen** klicken. Bei einem Fehler zeigt der Test die Meldung des Anbieters (z. B. falscher Key oder unbekanntes Modell).

**Anbieter, der nicht in der Liste steht:** „Eigener Anbieter (OpenAI-kompatibel)“ wählen und die **Basis-URL** eintragen, bis einschließlich `/v1`, zum Beispiel `https://api.groq.com/openai/v1`. Das Plugin ruft dann `<Basis-URL>/chat/completions` im OpenAI-Format auf. Erlaubt sind nur `https`-Adressen; `http` nur für `localhost`.

### Kosten

**Die Kosten trägst du selbst.** Das Plugin ist kostenlos, die KI-Anfragen laufen über deinen eigenen API-Key und werden von deinem KI-Anbieter nach dessen Preisliste abgerechnet. meiersworld.de erhält davon nichts und sieht weder Key noch Abrechnung. Prüfe die Preise deines Anbieters, bevor du die Box für viele Artikel freigibst, und lege beim Anbieter am besten ein Ausgabenlimit fest.

Jedes neue Gedicht ist eine kurze Anfrage an das gewählte KI-Modell (bei Haiku, Tanka und Elfchen manchmal zwei). Wiederholte Aufrufe derselben Kombination aus Artikel-Stand und Form kommen aus dem Cache (30 Tage) und kosten nichts. Das Tageslimit und das Limit pro IP halten die Kosten im Griff, ersetzen aber kein Ausgabenlimit beim Anbieter. Ändert sich ein Artikel, entstehen die Gedichte neu.

### Kennzeichnung

Unter jedem Gedicht steht ein Hinweis, dass es KI-generiert ist, mit Modellname und Datum. Der Hinweis lässt sich nicht abschalten, weil er der Transparenz gegenüber den Lesern dient.

### Datenschutz (bitte in deiner Datenschutzerklärung berücksichtigen)

- Beim Klick auf „Gedicht dichten“ sendet dein Server Titel und die ersten ca. 6.000 Zeichen des Artikels an den von dir gewählten KI-Anbieter (z. B. Anthropic). Sein Datenschutz und sein Vertragsstand gelten für diese Übertragung, bei Anbietern außerhalb der EU auch die Drittland-Regeln. Besucherdaten werden dabei nicht übertragen.
- Die IP-Adresse des Besuchers wird nur als Hash für das Stunden-Limit zwischengespeichert.

### Deinstallation

Plugin deaktivieren und löschen. Einstellungen und Zwischenspeicher werden entfernt, die Freigabe-Markierungen an den Artikeln bleiben erhalten.

### Für Entwickler

Filter: `mw_psm_enabled` (Freigabe), `mw_psm_lang` (Sprache), `mw_psm_post_types` (Typen), `mw_psm_forms` (verfügbare Formen), `mw_psm_client_ip` (IP-Ermittlung).

---

## English

### What it does

A box "Read this article as a poem" appears below an article. Visitors pick a form (for example haiku, limerick, sonnet or rap), one click, and an AI model of your choice condenses the article into a short poem. Below the poem a note states that it is AI-generated, with form, model name and date. Poems are cached: the same form for the same article revision costs only once.

You decide per article whether the box appears (checkbox in the editor), because not every post suits a poem.

### Forms

German: haiku, tanka, elfchen, limerick, spoonerism quatrain, sonnet, ballad (street-singer style), rap.
English: haiku, tanka, limerick, sonnet, ballad, rap, heroic couplets.

For haiku, tanka and elfchen the plugin counts syllables or words and lets the AI correct itself once. The syllable count is an approximation, and AI models are unreliable at counting syllables anyway. If you need exact counts, leave haiku and tanka out in the settings.

### Requirements

- WordPress 5.8+, PHP 7.0+
- Your **own** API key from an AI provider: Anthropic (Claude), OpenAI, Mistral, xAI (Grok), Google Gemini, OpenRouter or any OpenAI-compatible service. The plugin ships without a key and without a poem flat rate: costs arise at your provider, through your account.

### Installation

1. Download `poem-summary.zip`.
2. In WordPress: **Plugins → Add New → Upload Plugin**, choose the ZIP, **Install Now**, then **Activate**.
3. Open **Settings → Poem Summary**, choose the AI provider, enter its API key (and the model name, except for Anthropic), tick the content types (e.g. "Posts") and choose the poem forms. Save. Use **Test connection** to check the connection.
4. Open a post in the editor, tick **Enable poem box** in the **Poem Summary** sidebar box and update the post. Done.

The "Poem" column in the posts list shows where the box is enabled.

Instead of the settings field, the key can also be defined as the constant `MW_PSM_API_KEY` (for Anthropic also `ANTHROPIC_API_KEY`) in `wp-config.php`. That is safer because the key is then not stored in the database.

### Settings

| Setting | Meaning |
| --- | --- |
| AI provider, API key, model | Which provider writes the poems. For Anthropic `claude-haiku-4-5-20251001` is preset, for all others you enter the model name yourself. A larger model gives better rhymes and punchlines |
| Base URL | Only for "Custom provider" |
| Content types | Which types get the release checkbox, with a language per type (automatic, Deutsch, English). The language also decides the language of the poem |
| Poem forms | Which forms visitors see in the dropdown |
| Tone | Cheerful, serious, grand or dry and ironic |
| Default | Whether articles without an explicit release are enabled automatically (recommended: off) |
| Limits | Poems per IP and hour, new AI poems per day in total |
| Cloudflare | Tick if your site is behind Cloudflare, otherwise all visitors share one limit |
| Credit | Small "Idea: meiersworld.de" note in the box |

The box language follows the site language by default (the post language with Polylang). Override it with the `mw_psm_lang` filter.

### Using a provider other than Anthropic

1. Under **Settings → Poem Summary** choose the **AI provider**: OpenAI, Mistral AI, xAI (Grok), Google Gemini or OpenRouter. The API address is already built in.
2. Enter the provider's **API key** (create it in your provider account).
3. Enter the **model name** exactly as it appears in the provider's model list. Providers rename models often, so there is no preset here.
4. Save and click **Test connection**. On failure the test shows the provider's message (e.g. wrong key or unknown model).

**A provider that is not listed:** choose "Custom provider (OpenAI-compatible)" and enter the **base URL** up to and including `/v1`, for example `https://api.groq.com/openai/v1`. The plugin then calls `<base URL>/chat/completions` in the OpenAI format. Only `https` addresses are accepted; `http` only for `localhost`.

### Costs

**You bear the costs yourself.** The plugin is free; the AI requests run through your own API key and are billed by your AI provider according to its price list. meiersworld.de receives none of it and sees neither your key nor your billing. Check your provider's prices before enabling the box on many articles, and ideally set a spending limit with your provider.

Each new poem is one short request to the selected AI model (sometimes two for haiku, tanka and elfchen). Repeated views of the same article revision and form are served from the cache (30 days) at no cost. The daily limit and the per-IP limit keep costs under control but do not replace a spending limit at your provider. When an article changes, its poems are written anew.

### Labelling

Every poem carries a note that it is AI-generated, with model name and date. The note cannot be switched off because it serves transparency towards your readers.

### Privacy (please reflect this in your privacy policy)

- When a visitor clicks "Write poem", your server sends the title and the first ~6,000 characters of the article to the AI provider you selected (e.g. Anthropic). Its privacy terms and contract status apply to this transfer, including third-country rules for providers outside the EU. No visitor data is transmitted.
- The visitor's IP is only stored as a hash for the hourly limit.

### Uninstall

Deactivate and delete the plugin. Settings and cache are removed; the per-article release flags stay in place.

### For developers

Filters: `mw_psm_enabled` (release), `mw_psm_lang` (language), `mw_psm_post_types` (types), `mw_psm_forms` (available forms), `mw_psm_client_ip` (IP detection).

---

© 2026 [meiersworld.de](https://www.meiersworld.de) · GPL-2.0-or-later. Please keep the credit notice intact.
