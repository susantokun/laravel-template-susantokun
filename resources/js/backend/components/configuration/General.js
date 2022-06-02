import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default function General(props) {
    const data = JSON.parse(props.data)

    const [id, setId] = useState(data.id);
    const [code, setCode] = useState(data.code);
    const [title, setTitle] = useState(data.title);
    const [titleShort, setTitleShort] = useState(data.title_short);
    const [desc, setDesc] = useState(data.desc);
    const [slogan, setSlogan] = useState(data.slogan);
    const [author, setAuthor] = useState(data.author);
    const [facivonName, setFacivonName] = useState(data.favicon_name);
    const [faviconFile, setFaviconFile] = useState(data.favicon_file);
    const [logoName, setLogoName] = useState(data.logo_name);
    const [logoFile, setLogoFile] = useState(data.logo_file);
    const [keywords, setKeywords] = useState(data.keywords);
    const [metatext, setMetatext] = useState(data.metatext);
    const [placeOfBirth, setPlaceOfBirth] = useState(data.place_of_birth);
    const [dateOfBirth, setDateOfBirth] = useState(data.date_of_birth);
    const [apiKey, setApiKey] = useState(data.api_key);
    const [status, setStatus] = useState(data.status);

    return (
        <>
            <form>
                <div className="mt-4">
                    <input type="text" className="w-full" value={id} onChange={(e) => setId(e.target.value)} />
                    <input type="text" className="w-full" value={code} onChange={(e) => setCode(e.target.value)} />
                    <input type="text" className="w-full" value={title} onChange={(e) => setTitle(e.target.value)} />
                    <input type="text" className="w-full" value={titleShort} onChange={(e) => setTitleShort(e.target.value)} />
                    <input type="text" className="w-full" value={desc} onChange={(e) => setDesc(e.target.value)} />
                    <input type="text" className="w-full" value={slogan} onChange={(e) => setSlogan(e.target.value)} />
                    <input type="text" className="w-full" value={author} onChange={(e) => setAuthor(e.target.value)} />
                    <input type="text" className="w-full" value={facivonName} onChange={(e) => setFaviconName(e.target.value)} />
                    <input type="text" className="w-full" value={faviconFile} onChange={(e) => setFaviconFile(e.target.value)} />
                    <input type="text" className="w-full" value={logoName} onChange={(e) => setLogoName(e.target.value)} />
                    <input type="text" className="w-full" value={logoFile} onChange={(e) => setLogoFile(e.target.value)} />
                    <input type="text" className="w-full" value={keywords} onChange={(e) => setKeywords(e.target.value)} />
                    <input type="text" className="w-full" value={metatext} onChange={(e) => setMetatext(e.target.value)} />
                    <input type="text" className="w-full" value={placeOfBirth} onChange={(e) => setPlaceOfBirth(e.target.value)} />
                    <input type="text" className="w-full" value={dateOfBirth} onChange={(e) => setDateOfBirth(e.target.value)} />
                    <input type="text" className="w-full" value={apiKey} onChange={(e) => setApiKey(e.target.value)} />
                    <input type="text" className="w-full" value={status} onChange={(e) => setStatus(e.target.value)} />
                </div>
            </form>
        </>
    );
}

if (document.getElementById('general')) {
    const propsContainer = document.getElementById("general");
    const props = Object.assign({}, propsContainer.dataset);
    ReactDOM.render( <General {...props} />, document.getElementById("general") );
}

// if (document.getElementById('general')) {
//    var data = document.getElementById('general').getAttribute('data');
//    ReactDOM.render(<General data={data} />, document.getElementById('general'));
// }
