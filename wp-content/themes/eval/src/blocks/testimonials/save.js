import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save( { attributes } ) {
	const blockProps = useBlockProps.save( {
		className: 'section',
	} );
	return (
		<section { ...blockProps }>
			<div class="content-container">
				<RichText.Content
					tagName="h2"
					style={ { textAlign: 'center' } }
					value={ attributes.title }
				/>
				<RichText.Content
					tagName="p"
					style={ { textAlign: 'center' } }
					value={ attributes.subText }
				/>
				<div className="testimonials">
					<div className="testimonials__list">
						{ attributes.testimonials.map( ( testimonial ) => (
							<div key={ `testimonial-${ testimonial.id }` }>
								<h3>{ testimonial.title.rendered }</h3>
								<div
									dangerouslySetInnerHTML={ {
										__html: testimonial.excerpt.rendered,
									} }
								/>
							</div>
						) ) }
					</div>
					<InnerBlocks.Content />
				</div>
			</div>
		</section>
	);
}
