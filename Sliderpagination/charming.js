function charming(element, options) {
  options = options || {};
  var tagName = options.tagName || 'span';
  var split = options.split || function (string) { return Array.from(string); };
  var setClassName = options.setClassName || function (index, letter) { return 'char' + (index + 1); };

  if (!element.childNodes.length) {
    return;
  }

  var wrapper = document.createElement(tagName);
  var label = '';
  split(element.textContent).forEach(function (letter, index) {
    if (letter.trim() === '') {
      wrapper.appendChild(document.createTextNode(letter));
      return;
    }
    var charNode = document.createElement(tagName);
    charNode.textContent = letter;
    charNode.setAttribute('aria-hidden', true);
    charNode.className = setClassName(index, letter);
    wrapper.appendChild(charNode);
    label += letter;
  });

  element.setAttribute('aria-label', label);
  element.innerHTML = wrapper.outerHTML;
}
