# Fixes
* [wpmlcore-3291] Improved query validation used for caching strings
* [wpmlcore-3280] Fixed `Fatal error: Uncaught exception 'InvalidArgumentException' with message 'Argument ID must be numeric and greater than 0` when filtering permalinks
* [wpmlcore-3278] Fixed fatal error appearing during upgrade: `WordPress database error: specified key was too long; max key length is 1000`
* [wpmlcore-3273] Fixed uncaught exception in cases where `domain_name_context_md5` column didn't exist in `icl_strings` table
* [wpmlcore-3272] Fixed `Fatal error: Declaration of WPML_Post_Element::get_type() must be compatible with that of WPML_Translation_Element::get_type()` for PHP 5.2