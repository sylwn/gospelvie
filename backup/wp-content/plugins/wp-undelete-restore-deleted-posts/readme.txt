=== WP Undelete: Restore Deleted Posts ===
Contributors: Joss Crowcroft
Donate link: http://josscrowcroft.com/swag/wp-undelete-restore-deleted-posts-wordpress-plugin/
Tags: undelete, restore, deleted, posts, trash, admin, backup
Requires at least: 3.1
Tested up to: 3.1.2
Stable tag: 0.0.1

Adds the ability to undelete/restore deleted posts, even after emptying the trash or 'permanently deleting' them. First release.

== Description ==

**WP Undelete** adds the ability to undelete/restore deleted posts, even after emptying the trash or 'permanently deleting' them.

*Please note:* this plugin is a first-release version with many features 'missing' or not implemented yet. For now, it will allow you to restore only posts (custom post types/pages support coming in next release!) and comments of deleted posts, as well as tags and category associations, are lost (again, this will be a feature of the next version!)

I'm not the only person who's accidentally hit "Delete Permanently" or "Empty Trash" on posts - just recently a client of mine lost an entire day's work, some 80 items, after emptying the Trash without thinking. It got me thinking "Man, I wish I could undelete stuff."

WP Undelete is like a backup utility for stuff you delete. It operates in the background, without any input from you, and you won't even know it's there - until you need it.

It's lightweight, simple and won't slow your site down in any way.

Please try it out, report any bugs that pop up, and watch out for the next release (0.1) which will feature support for **custom post types and pages** as well as **saving of comments** and other post-related data.

Check out [WP Undelete Homepage](http://josscrowcroft.com/swag/wp-undelete-restore-deleted-posts-wordpress-plugin/ "WP Undelete: Restore Deleted Posts - WordPress Plugin") for more info and comments.

== Installation ==

1. Download **Undelete** and upload via the Plugins > Add New page (or search and install inside WordPress)
2. Activate the plugin.
3. Everything else is automatic. When you get overexcited and accidentally delete something important, head over to **Tools** > **Undelete/Restore** to get it back.
4. Leave a comment on the plugin page if you need any help. Let's face it though, if you can tie your shoelaces, you can probably install this plugin. No offence meant to anybody who can't tie their shoelaces... but come on... seriously?

== Frequently Asked Questions ==

= Are comments, postmeta, tags and categories on deleted posts able to be restored? =

Watch out for v0.1 :)

= Does Undelete support custom post types or pages? =

As above.

= Will it slow my site down or make the database bloated? =

Not one bit - every time you empty the Trash or permanently delete a post, it's simply copied over to a backup database table, which is never accessed until you visit the plugin's page to view deleted posts. The Deleted Posts database can be emptied from inside the plugin's page, and posts are deleted when they've been in there for more than 28 days.

== Screenshots ==

Please see [WP Undelete Homepage](http://josscrowcroft.com/swag/wp-undelete-restore-deleted-posts-wordpress-plugin/ "WP Undelete: Restore Deleted Posts - WordPress Plugin") for screenshots;

== Changelog ==

= 0.0.1 =
* First version
* Support for undeleting/restoring deleted posts
* Clear out deleted posts after 28 days

== Roadmap ==

= 0.1 =
* Add support for restoring static pages
* Add support for restoring custom post types
* Make sure attachments/revisions are restored along with parent post
* Retain postmeta values on deleted posts
* Finish commenting code

= Later =
* Ability to restore deleted comments
* Retain category/tag/taxonomy associations on deleted items

== Upgrade Notice ==

= 0.0.1 =

First version