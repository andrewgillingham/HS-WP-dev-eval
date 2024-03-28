import { useBlockProps, RichText } from '@wordpress/block-editor';

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
					style={ { textAlign: 'center' } }
					tagName="h2"
					value={ attributes.title }
				/>
				[taxonomy_query]
			</div>
		</section>
	);
}
