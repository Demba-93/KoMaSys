/**
 * Default configuration
 * @typ {Object}
 */
export const defaultConfig = {
    sortable: true,
    searchable: true,

    // Pagination
    paging: true,
    perPage: 10,
    perPageSelect: [5, 10, 15, 20, 25],
    nextPrev: true,
    firstLast: false,
    prevText: "&lsaquo;",
    nextText: "&rsaquo;",
    firstText: "&laquo;",
    lastText: "&raquo;",
    ellipsisText: "&hellip;",
    ascText: "▴",
    descText: "▾",
    truncatePager: true,
    pagerDelta: 2,

    scrollY: "",

    fixedColumns: true,
    fixedHeight: false,

    header: true,
    hiddenHeader: false,
    footer: false,

    // Customise the display text
    labels: {
        placeholder: "Suchen...", // The search input placeholder
        perPage: "{select} Einträge pro Seite", // per-page dropdown label
        noRows: "Es wurde keine Ergebniss", // Message shown when there are no records to show
        noResults: "Es wurde keine Ergebnisse zu Ihre Anfrage gefunden", // Message shown when there are no search results
        info: "{start} bis {end} von {rows} Einträgen" //
    },

    // Customise the layout
    layout: {
        top: "{select}{search}",
        bottom: "{info}{pager}"
    }
}
