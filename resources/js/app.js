import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import hljs from 'highlight.js/lib/core';
import 'highlight.js/styles/github-dark.min.css';

// Optionally register languages for highlight.js (auto-detects by default, but you can add specific ones)
import javascript from 'highlight.js/lib/languages/javascript';
import php from 'highlight.js/lib/languages/php';
import xml from 'highlight.js/lib/languages/xml';
import css from 'highlight.js/lib/languages/css';

hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('php', php);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('css', css);

window.hljs = hljs;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightElement(block);
    });
});
