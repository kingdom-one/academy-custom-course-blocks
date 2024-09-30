import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import block from './block.json';

registerBlockType( block.name, {
	apiVersion: 3,
	title: block.title,
	icon: block.icon,
	category: block.category,
	attributes: block.attributes,
	edit: ( { attributes, setAttributes } ) => {
		const { price } = attributes;
		const blockProps = useBlockProps( {
			className: 'k1-course-price',
		} );
		return (
			<div { ...blockProps }>
				<RichText
					tagName="p"
					value={ price }
					onChange={ ( price ) => {
						setAttributes( { price } );
					} }
					placeholder="Enter course price..."
				/>
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
