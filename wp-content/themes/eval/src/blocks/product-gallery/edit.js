import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	return (
		<div { ...useBlockProps() }>
			<h2>Gallery</h2>
			<InnerBlocks
				allowedBlocks={ [ 'core/gallery' ] }
				template={ [ [ 'core/gallery', { columns: 3, images: [] } ] ] }
				templateLock="all"
			/>
		</div>
	);
}
