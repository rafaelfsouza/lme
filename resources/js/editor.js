window.Quill = require('quill')

let BlockEmbed = Quill.import('blots/block/embed');

class ImageBlot extends BlockEmbed {
  static create(value) {
    let node = super.create();
    node.setAttribute('src', value.src);
    node.setAttribute('class', 'img-fluid')
    return node;
  }

  static value(node) {
    return {
      src: node.getAttribute('src'),
      class: node.getAttribute('class')
    };
  }
}
ImageBlot.blotName = 'imageBootstrap';
ImageBlot.tagName = 'img';

Quill.register(ImageBlot);