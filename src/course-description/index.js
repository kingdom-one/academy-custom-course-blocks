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
		const { description } = attributes;
		const blockProps = useBlockProps( {
			className: 'k1-course-description',
		} );
		return (
			<div { ...blockProps }>
				<RichText
					tagName="p"
					value={ description }
					onChange={ ( description ) => {
						setAttributes( { description } );
					} }
					placeholder="Enter course description..."
				/>
			</div>
		);
	},
	save: () => null, // Server-side rendering.
} );
