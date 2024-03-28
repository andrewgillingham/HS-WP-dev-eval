import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { SelectControl, PanelBody, PanelRow } from '@wordpress/components';
import { useBlockProps, InspectorControls, InnerBlocks, RichText } from '@wordpress/block-editor';
import './style.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit({ attributes, setAttributes }) {
  console.log('🚀 ~ Edit ~ attributes:', attributes);
  const [testimonials, setTestimonials] = useState([]);
  const [selectedTestimonials, setSelectedTestimonials] = useState([]);

  useEffect(() => {
    // Fetch taxonomies
    apiFetch({ path: '/wp/v2/testimonial' }).then((testimonials) => {
      setTestimonials(Object.values(testimonials));
    });

    fetchSelectedTestimonials(attributes.testimonials);
  }, [attributes]);

  const fetchSelectedTestimonials = function (testimonialIds) {
    return apiFetch({ path: `/wp/v2/testimonial?include=${testimonialIds.join(',')}` });
  };

  return (
    <div {...useBlockProps()}>
      <RichText
        tagName="h2"
        style={{ textAlign: 'center' }}
        value={attributes.title}
        placeholder="Enter title..."
        onChange={(value) => setAttributes({ title: value })}
      />
      <RichText
        tagName="p"
        style={{ textAlign: 'center' }}
        value={attributes.subText}
        placeholder="Enter subtext..."
        onChange={(value) => setAttributes({ subText: value })}
      />
      <div className="testimonials">
        <div>
          {attributes.testimonials.map((testimonial) => (
            <div key={`testimonial-${testimonial.id}`}>
              <h2>{testimonial.title.rendered}</h2>
              <div dangerouslySetInnerHTML={{ __html: testimonial.excerpt.rendered }} />
            </div>
          ))}
        </div>
        <div>
          <InnerBlocks allowedBlocks={['core/image']} template={[['core/image', {}]]} templateLock="all" />
        </div>
      </div>
      <InspectorControls>
        <PanelBody title="Testimonial Settings">
          <PanelRow>
            <SelectControl
              label="Select Testimonial"
              multiple
              value={attributes.testimonials.map((testimonial) => testimonial.id)}
              options={testimonials.map((testimonial) => ({ label: testimonial.title.rendered, value: testimonial.id }))}
              onChange={(value) => {
                fetchSelectedTestimonials(value).then((selectedTestimonials) => {
                  setAttributes({
                    testimonials: selectedTestimonials,
                  });
                });
              }}
            />
          </PanelRow>
        </PanelBody>
      </InspectorControls>
    </div>
  );
}
