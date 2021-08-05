$(document).ready(function() {
    var SITE_ASSETS_PATH = $("input#site-public-asset-path").val();
    /**
     * seting up ajax csrf checking
     */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    /**
     * generic scripts at page load
     */
    $(document).ready(function() {
        tinymce.init({
            selector: "#domain_description",
            branding: false,
            menubar: false,
            height: 200,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste code help wordcount"
            ],
            toolbar:
                "undo redo | formatselect | " +
                "bold italic backcolor | alignleft aligncenter " +
                "alignright alignjustify | bullist numlist outdent indent | " +
                "removeformat | help"
        });
        $("select#template_name").on("change", function() {
            let domain_tmp_name = $(this).val();

            $('input[name="selected_domain_template"]').val(domain_tmp_name);
            if (domain_tmp_name) {
                $(
                    "div.domain-options-section .form-group." + domain_tmp_name
                ).removeClass("d-none");
                $("div.domain-options-section .form-group")
                    .not(
                        "div.domain-options-section .form-group." +
                            domain_tmp_name
                    )
                    .addClass("d-none");

                //update preview image src
                $("img.selected-template-preview-img").attr(
                    "src",
                    SITE_ASSETS_PATH +
                        "domain-templates/" +
                        domain_tmp_name +
                        "/" +
                        domain_tmp_name +
                        ".png"
                );
                $("img.selected-template-preview-img").fadeIn(500);

                //update buy offer/ rental url label text
                if (domain_tmp_name === "domain-tmp-for-rent") {
                    $(".buy-rent-url-label").text("Rental URL");
                } else {
                    $(".buy-rent-url-label").text("Buy/Offer URL");
                }
            }
        });

        /**
         * trigger change event if domain template already selected
         */
        let selected_domain_template = $(
            'input[name="selected_domain_template"]'
        ).val();

        if (selected_domain_template) {
            $("select#template_name").val(selected_domain_template);
            $("select#template_name").trigger("change");
        }
    });

    /**
     * active nav-link feature
     */
    $(document).ready(function() {
        let current_page_url = window.location.href;
        let page_url = current_page_url.split(location.hostname);
        $(".prospect-sidebar-nav a.nav-link").removeClass("active");
        $(
            '.prospect-sidebar-nav a.nav-link[href="' + page_url[1] + '"]'
        ).addClass("active");
    });

    /**
     * user analytics page datatables
     */
    $(document).ready(function() {
        $("#analytics_reporting_table").DataTable({
            paging: false,
            info: false,
            dom: "Bfrtip",
            buttons: ["csv", "excel", "pdf", "print"]
        });
    });

    /**
     * init CKE editor when template pages loads first time
     */
    $(document).ready(function() {
        let selected_template = $("input#selected_template").val();
        let create_page = $("div.template-create-page");
        if (selected_template && create_page.length > 0) {
            generate_ck_editor(selected_template, selected_template);
        }

        if ($("div.shortcode-edit-page").length > 0) {
            //generate template links on edit page load
            generate_shortcode_links();
        }

        if ($("div.template-edit-page").length > 0) {
            //generate template links on edit page load
            generate_template_links();
            //generate ckeditor instance
            CKEDITOR.replace(selected_template + "editor", {
                width: "100%",
                height: 600,
                allowedContent: true,
                removeButtons: ""
            });
        }
    });

    /**
     * select template script
     */
    $("a.template-box-link").on("click", function() {
        $("a.template-box-link").removeClass("active");
        $(this).addClass("active");
        $("input#selected_template").val($(this).data("type"));
    });

    /**
     * hide template selection div
     */
    $("a.selected-template-btn").on("click", function() {
        $("div.template-selection-section").slideUp(500);
        $("div.template-content-section").slideDown(1000);
        //update ckeditor content
        let selected_template = $("input#selected_template").val();
        generate_ck_editor(selected_template, selected_template);
    });

    /**
     * Add cusotm variables
     */
    $(".add-custom-var-btn").on("click", function(e) {
        e.preventDefault();

        let text = $(this).data("val");
        let slug = $("input#selected_template").val();
        if (slug) {
            insertAtCursorCKEEDITOR(slug, text);
        } else {
            alert("Kindly select a template first!");
        }
    });

    /**
     * copy actual template link
     */
    //copy short url to clippboard
    $("a#template-saas-copy-btn").click(function(e) {
        e.preventDefault();
        copyUrl($("input#template-saas-link"));
        $(this)
            .attr("title", "Copied")
            .tooltip("_fixTitle")
            .tooltip("show");
    });

    $("a#template-actual-site-link-btn").click(function(e) {
        e.preventDefault();
        copyUrl($("input#template-actual-site-link"));
        $(this)
            .attr("title", "Copied")
            .tooltip("_fixTitle")
            .tooltip("show");
    });
    $("a#copy-embed-code-btn").click(function(e) {
        e.preventDefault();
        copyUrl($("#prospect-embed-code-input"));
        $(this)
            .attr("title", "Copied")
            .tooltip("_fixTitle")
            .tooltip("show");
    });

    /**
     * Generate shortcode links function
     */
    function generate_shortcode_links() {
        let template_id = $('input[name="template_id"]').val();

        $.ajax({
            type: "GET",
            url: "/template/get/" + template_id,
            success: function(data) {
                if (data) {
                    let params_obj = {
                        first_name: data.param_f_name,
                        last_name: data.param_l_name,
                        full_name: data.param_full_name,
                        company: data.param_company_name
                    };

                    $.each(params_obj, function(key, value) {
                        if (value === "" || value === null) {
                            delete params_obj[key];
                        }
                    });

                    let query_params = "";
                    if (!$.isEmptyObject(params_obj)) {
                        query_params = "?" + $.param(params_obj);
                    }

                    //actual site link
                    let actual_link =
                        $.trim($("input#template-actual-site-link").val()) +
                        query_params;
                    $("input#template-actual-site-link").val(actual_link);
                }
            }
        });
    }

    /**
     * Generate template links function
     */
    function generate_template_links() {
        let template_id = $('input[name="template_id"]').val();
        $.ajax({
            type: "GET",
            url: "/template/get/" + template_id,
            success: function(data) {
                if (data) {
                    let markup = data.template_content;
                    let domVars = markup
                        .match(/{{\s*[\w\.]+\s*}}/g)
                        .map(function(x) {
                            return x.match(/[\w\.]+/)[0];
                        });
                    let dummy_vars = {
                        first_name: data.param_f_name,
                        last_name: data.param_l_name,
                        full_name: data.param_full_name,
                        company: data.param_company_name
                    };

                    let params_obj = {};

                    if (domVars) {
                        let cust_vars = domVars.map(function(x) {
                            let v = x.match(/[\w\.]+/)[0];
                            params_obj[v] = dummy_vars[v];
                            return v;
                        });

                        let query_params = "?" + $.param(params_obj);
                        //saas based link
                        $("input#template-saas-link").val(
                            $("input#template-saas-link").val() + query_params
                        );
                        $("a#template-saas-link-btn").attr(
                            "href",
                            $("a#template-saas-link-btn").attr("href") +
                                query_params
                        );
                    }
                }
            }
        });
    }

    /**
     * CKEditor data feed
     */
    function generate_ck_editor(tmp_slug, selected_template) {
        $.ajax({
            type: "POST",
            url: "/user/templates/content",
            data: { selected_template: selected_template },
            success: function(data) {
                if (data) {
                    $(document)
                        .find(".cke-editor-instance")
                        .remove();
                    let editor = getCKEditor(tmp_slug, "cke-editor-instance");
                    $("div.template-ckeditor-section").append(editor);
                    initCkEditor(tmp_slug, data);
                }
            }
        });
    }
    function getCKEditor(type, addClass = "") {
        return `
            <div id="${type}" class="${addClass}">
                <textarea name="${type + "editor"}"></textarea>
            </div>
          `;
    }
    function initCkEditor(slug, data) {
        CKEDITOR.replace(slug + "editor", {
            width: "100%",
            height: 600,
            allowedContent: true,
            removeButtons: ""
        });
        CKEDITOR.instances[slug + "editor"].setData(data);
    }
    //insert values in ckeditor at cursor
    function insertAtCursorCKEEDITOR(slug, text) {
        slug = slug + "editor";
        CKEDITOR.instances[slug].insertText(text);
    }
});

if ($("canvas#feedChart").length > 0) {
    let user_id = $("input#analytics_user_id").val();
    $.ajax({
        type: "GET",
        url: "/user/analytics/" + user_id + "/visits",
        data: {},
        success: function(data) {
            if (data.labels.length > 0) {
                console.log(data);
                generate_visits_feed_chart(data.labels, data.visits);
            } else {
                $("div.chart").append(
                    "<h2 class='text-center text-muted'>&#128558; No analytics data found yet!</h2>"
                );
            }
        }
    });
}

function generate_visits_feed_chart(labels, visits) {
    var feedChart = new Chart("feedChart", {
        type: "bar",
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            stepSize: 4,
                            callback: function(value) {
                                return value + " Visits";
                            }
                        }
                    }
                ]
            }
        },
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Visits",
                    data: visits
                }
            ]
        }
    });
}

/**
 * copy text from element
 */
function copyUrl(copyText) {
    copyText.disabled = false;
    copyText.select();
    //copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    copyText.disabled = true;
}
