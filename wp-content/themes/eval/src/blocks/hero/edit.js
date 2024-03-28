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
			<InnerBlocks
				template={ [
					[
						'core/columns',
						{},
						[
							[
								'core/column',
								{
									width: '55%',
									verticalAlignment: 'middle',
								},
								[
									[
										'core/heading',
										{
											placeholder: 'Enter title...',
											level: 1,
										},
									],
									[
										'core/paragraph',
										{ placeholder: 'Enter description...' },
									],
									[
										'core/button',
										{ placeholder: 'Add Link Text' },
									],
								],
							],
							[
								'core/column',
								{
									width: '45%',
								},
								[ [ 'core/image' ] ],
							],
						],
					],
				] }
				templateLock="all"
			/>
		</div>
	);
}
