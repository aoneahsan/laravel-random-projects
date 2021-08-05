setTimeout(function() {
    let markup = document.documentElement.innerHTML;
    let domVars = markup.match(/{{\s*[\w\.]+\s*}}/g).map(function(x) {
        return x.match(/[\w\.]+/)[0];
    });
    let urlVars = getUrlVars();
    for (let urlVar in urlVars) {
        for (let domVar of domVars) {
            if (urlVar === domVar) {
                let elems = document.body.children;
                for (let i = 0; i < elems.length; i++) {
                    let usIt = urlVars[urlVar];
                    usIt = usIt.split("+").join(" ");
                    elems[i].innerHTML = elems[i].innerHTML.replace(
                        "{{" + domVar + "}}",
                        decodeURI(usIt)
                    );
                }
            }
        }
    }
}, 0);

function getUrlVars() {
    let vars = {};
    let parts = window.location.href.replace(
        /[?&]+([^=&]+)=([^&]*)/gi,
        function(m, key, value) {
            vars[key] = value;
        }
    );
    return vars;
}
