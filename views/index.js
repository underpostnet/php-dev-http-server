

// ---------------------------------------------------------------------
// const data
// ---------------------------------------------------------------------

const renderSelector = "render";
const viewPaths = [
    {
        title: "underpost.net",
        menu: "Inicio",
        path: baseUri+"/",
    },
    {
        title: "Tienda - underpost.net",
        menu: "Tienda",
        path: baseUri+"/tienda"
    },
    {
        title: "Contacto - underpost.net",
        menu: "Contacto",
        path: baseUri+"/contacto"
    },
];
const idg = 5; // random id generator length

// ---------------------------------------------------------------------
// menu render
// ---------------------------------------------------------------------

const _MENU = () => {
    return /*html*/`
            <style>
                .menu-content  {

                }
                .menu-btn {

                }                
            </style>
            <div class="in menu-content">
                    ${viewPaths.map(_dataView => {
        const _id = makeid(idg);
        setTimeout(() =>
            s("." + _id).onclick = () =>
                window._ROUTER(_dataView.path)
            , 0);
        return /*html*/`

                        <div class="inl menu-btn ${_id}">
                                ${_dataView.menu}
                        </div>                              
                    
                        `;
    }).join('')}
            </div>
    `
};

// ---------------------------------------------------------------------
// main render
// ---------------------------------------------------------------------

window._RENDER = dataView => {

    append(renderSelector, /*html*/`
             
                <br>
                <br>

                <pre>
                ${jsonSave(dataView)}
                </pre>    

                <br>

                ${_MENU()}                


    `);

};

// ---------------------------------------------------------------------
// router
// ---------------------------------------------------------------------


window._ROUTER = UriView => {

    // Clean Screen
    !s(renderSelector) ? append("body", /*html*/`<${renderSelector}></${renderSelector}>`) : null;
    htmls(renderSelector, '');

    // Router
    for (let dataView of viewPaths) {
        
        const buildUriView =  (UriView == undefined ? getUriPath(baseUri) : UriView);

        console.log(dataView.path);
        console.log(buildUriView);
        console.log('--');
        
        if (dataView.path == buildUriView) {
            if (UriView) {
                setURI(dataView.path);
                htmls("title", dataView.title);
            }
            return window._RENDER(dataView);
        }
    }

    return UriView == undefined ? null : location.href = UriView ;

};

// Browser and App
// navigator button controller
window.onpopstate = e =>
    window._ROUTER();

// Init App
window._ROUTER();











// ---------------------------------------------------------------------
// ---------------------------------------------------------------------