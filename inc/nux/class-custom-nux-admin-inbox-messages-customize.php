<?php
/**
 * custom NUX Admin Inbox Messages.
 *
 * @package  custom
 * @since    3.0.0
 */

use Automattic\WooCommerce\Admin\Notes\Note;
use Automattic\WooCommerce\Admin\Notes\NoteTraits;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'custom_NUX_Admin_Inbox_Messages_Customize' ) ) :
	/**
	 * The initial custom inbox Message.
	 */
	class custom_NUX_Admin_Inbox_Messages_Customize {

		use NoteTraits;

		/**
		 * Name of the note for use in the database.
		 */
		const NOTE_NAME = 'custom-customize';

		/**
		 * Get the note.
		 *
		 * @return Note
		 */
		public static function get_note() {
			$note = new Note();
			$note->set_title( __( 'Design your store with custom 🎨', 'custom' ) );
			$note->set_content( __( 'Visit the custom settings page to start setup and customization of your shop.', 'custom' ) );
			$note->set_type( Note::E_WC_ADMIN_NOTE_INFORMATIONAL );
			$note->set_name( self::NOTE_NAME );
			$note->set_content_data( (object) array() );
			$note->set_source( 'custom' );
			$note->add_action(
				'customize-store-with-custom',
				__( 'Let\'s go!', 'custom' ),
				admin_url( 'themes.php?page=custom-welcome' ),
				Note::E_WC_ADMIN_NOTE_ACTIONED,
				true
			);
			return $note;
		}
	}
endif;
