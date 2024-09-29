import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import block from './block.json';

registerBlockType( block.name, {
	title: block.title,
	icon: block.icon,
	category: block.category,
	attributes: {
		description: {
			type: 'string',
			source: 'meta',
			meta: 'description_meta_key',
		},
	},
	edit: ( { attributes, setAttributes } ) => {
		const blockProps = useBlockProps();
		return (
			<div { ...blockProps }>
				<RichText
					tagName="p"
					value={ attributes.description }
					onChange={ ( value ) =>
						setAttributes( { description: value } )
					}
					placeholder="Enter course description..."
				/>
			</div>
		);
	},
	save: () => {
		return null; // Server-side rendering
	},
} );
