/**
 * send ajax call when document is ready.
 */

//const PROSPECT_API_URL = "http://prospect-saas.test";
const PROSPECT_API_URL = "https://app.prospectdynamic.com";
if (
    PROSPECT_CONFIG.shortcode_id &&
    PROSPECT_CONFIG.site_token &&
    PROSPECT_CONFIG.user_id
) {
    loadProspectTemplate();
}

function loadProspectTemplate() {
    let xmlhttp = new XMLHttpRequest();
    let params = Object.keys(PROSPECT_CONFIG)
        .map(function(key) {
            return key + "=" + PROSPECT_CONFIG[key];
        })
        .join("&");
    params = "?" + params;
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
            // XMLHttpRequest.DONE == 4
            if (xmlhttp.status == 200) {
                if (xmlhttp.responseText) {
                    //append custom variable script
                    let vars_script = document.createElement("script");
                    vars_script.onload = function() {
                        console.log("custom vars script is loaded and ready!");
                    };
                    vars_script.src =
                        PROSPECT_API_URL + "/js/embed-custom-vars.js";
                    document.body.appendChild(vars_script);

                    //count vists for users
                    countProspectVisits();
                }

                //document.body.appendChild(prospeectDiv);
            } else if (xmlhttp.status == 400) {
                console.log("There was an error 400");
            } else {
                console.log("something else other than 200 was returned");
            }
        }
    };

    xmlhttp.open(
        "GET",
        PROSPECT_API_URL + "/api/user/get_template/" + params,
        true
    );
    xmlhttp.send();
}

function countProspectVisits() {
    let xmlhttp = new XMLHttpRequest();
    let params = Object.keys(PROSPECT_CONFIG)
        .map(function(key) {
            return key + "=" + PROSPECT_CONFIG[key];
        })
        .join("&");

    let page_url = location.protocol + "//" + location.host + location.pathname;
    let custom_query_vars = window.location.search;
    params =
        params +
        "&page_url=" +
        page_url +
        "&template_id=" +
        PROSPECT_CONFIG.shortcode_id;

    //fetch query params from url
    if (custom_query_vars) {
        params = custom_query_vars + "&" + params;
    } else {
        params = "?" + params;
    }

    console.log(params);

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
            // XMLHttpRequest.DONE == 4
            if (xmlhttp.status == 200) {
                console.log(xmlhttp.responseText);
            } else if (xmlhttp.status == 400) {
                console.log("There was an error 400");
            } else {
                console.log("something else other than 200 was returned");
            }
        }
    };

    xmlhttp.open(
        "GET",
        PROSPECT_API_URL + "/api/user/count_visit/" + params,
        true
    );
    xmlhttp.send();
}
