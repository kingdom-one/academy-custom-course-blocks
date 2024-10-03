import React from '@wordpress/element';

const style = {
	backgroundColor: '#f5f5f5',
	border: '4px solid #2b3636',
	fontStyle: 'italic',
	padding: 8,
};

const titleStyle = {
	color: '#2b3636',
	fontSize: 16,
	marginBottom: 8,
	fontWeight: 'bold',
};

export default function PlaceholderBlock( {
	title,
	message,
	messageIsHTML = false,
}: {
	title?: string;
	message: string;
	messageIsHTML: boolean;
} ) {
	return (
		<div className="k1-placeholder-block" style={ style }>
			{ title && <h2 style={ titleStyle }>{ title }</h2> }
			{ messageIsHTML ? (
				<p dangerouslySetInnerHTML={ { _html: message } } />
			) : (
				<p>{ message }</p>
			) }
		</div>
	);
}
