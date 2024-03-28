import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { SelectControl, PanelBody, PanelRow } from '@wordpress/components';
import {
	useBlockProps,
	InspectorControls,
	InnerBlocks,
	RichText,
} from '@wordpress/block-editor';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit( { attributes, setAttributes } ) {
	const [ taxonomies, setTaxonomies ] = useState( [] );

	useEffect( () => {
		// Fetch taxonomies
		apiFetch( { path: '/wp/v2/taxonomies' } ).then( ( taxonomies ) => {
			setTaxonomies( Object.values( taxonomies ) );
		} );
	}, [] );
	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title="Taxonomy Settings">
					<PanelRow>
						<SelectControl
							label="Select Taxonomy"
							value={ attributes.taxonomy }
							options={ taxonomies.map( ( taxonomy ) => ( {
								label: taxonomy.name,
								value: taxonomy.slug,
							} ) ) }
							onChange={ ( value ) => {
								setAttributes( {
									taxonomy: value,
								} );
							} }
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<RichText
				tagName="h2"
				style={ { textAlign: 'center' } }
				value={ attributes.title }
				placeholder="Enter title..."
				onChange={ ( value ) => setAttributes( { title: value } ) }
			/>
			<p style={ { textAlign: 'center' } }>
				On the frontend this will show cards for each taxnonomy term
				selected.
			</p>
		</div>
	);
}
