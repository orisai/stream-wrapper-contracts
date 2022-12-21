<?php declare(strict_types = 1);

namespace Orisai\StreamWrapperContracts;

use const LOCK_EX;
use const LOCK_NB;
use const LOCK_SH;
use const LOCK_UN;
use const SEEK_CUR;
use const SEEK_END;
use const SEEK_SET;
use const STREAM_CAST_AS_STREAM;
use const STREAM_CAST_FOR_SELECT;
use const STREAM_META_ACCESS;
use const STREAM_META_GROUP;
use const STREAM_META_GROUP_NAME;
use const STREAM_META_OWNER;
use const STREAM_META_OWNER_NAME;
use const STREAM_META_TOUCH;
use const STREAM_MKDIR_RECURSIVE;
use const STREAM_OPTION_BLOCKING;
use const STREAM_OPTION_READ_BUFFER;
use const STREAM_OPTION_READ_TIMEOUT;
use const STREAM_OPTION_WRITE_BUFFER;
use const STREAM_REPORT_ERRORS;
use const STREAM_URL_STAT_LINK;
use const STREAM_URL_STAT_QUIET;
use const STREAM_USE_PATH;

/**
 * phpcs:disable Generic.NamingConventions.CamelCapsFunctionName.ScopeNotCamelCaps
 *
 * @see https://www.php.net/streamwrapper
 */
interface StreamWrapper
{

	public const CastsAs = [
		STREAM_CAST_AS_STREAM,
		STREAM_CAST_FOR_SELECT,
	];

	public const LOCK_SH = LOCK_SH,
		LOCK_EX = LOCK_EX,
		LOCK_UN = LOCK_UN,
		LOCK_NB = LOCK_NB;

	public const MetadataOptions = [
		STREAM_META_TOUCH,
		STREAM_META_OWNER_NAME,
		STREAM_META_OWNER,
		STREAM_META_GROUP_NAME,
		STREAM_META_GROUP,
		STREAM_META_ACCESS,
	];

	public const OpensModes = [
		'r',
		'rb',
		'rt',
		'r+',
		'r+b',
		'r+t',
		'w',
		'wb',
		'wt',
		'w+',
		'w+b',
		'w+t',
		'a',
		'ab',
		'at',
		'a+',
		'a+b',
		'a+t',
		'x',
		'xb',
		'xt',
		'x+',
		'x+b',
		'x+t',
		'c',
		'cb',
		'ct',
		'c+',
		'c+b',
		'c+t',
		'e',
		'eb',
		'et',
	];

	public const OpensOptions = [
		0,
		STREAM_USE_PATH,
		STREAM_REPORT_ERRORS,
	];

	public const SeeksWhence = [
		SEEK_SET,
		SEEK_CUR,
		SEEK_END,
	];

	public const SetOptionOptions = [
		STREAM_OPTION_BLOCKING,
		STREAM_OPTION_READ_BUFFER,
		STREAM_OPTION_READ_TIMEOUT,
		STREAM_OPTION_WRITE_BUFFER,
	];

	public const UrlStatsFlags = [
		0,
		STREAM_URL_STAT_LINK,
		STREAM_URL_STAT_QUIET,
	];

	public const MkdirsOptions = [
		0,
		STREAM_MKDIR_RECURSIVE,
	];

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.dir-closedir.php
	 */
	public function dir_closedir(): bool;

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.dir-opendir.php
	 */
	public function dir_opendir(string $path, int $options): bool;

	/**
	 * @return string|false
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.dir-readdir.php
	 */
	public function dir_readdir();

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.dir-rewinddir.php
	 */
	public function dir_rewinddir(): bool;

	/**
	 * @phpstan-param int-mask-of<self::MkdirsOptions> $options
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.mkdir.php
	 */
	public function mkdir(string $path, int $mode, int $options): bool;

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.rename.php
	 */
	public function rename(string $path_from, string $path_to): bool;

	/**
	 * @phpstan-param int-mask-of<self::MkdirsOptions> $options
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.rmdir.php
	 */
	public function rmdir(string $path, int $options): bool;

	/**
	 * @phpstan-param value-of<self::CastsAs> $cast_as
	 * @return false
	 *
	 * @see https://www.php.net/streamwrapper.stream-cast
	 */
	public function stream_cast(int $cast_as): bool;

	/**
	 * @see https://www.php.net/streamwrapper.stream-close
	 */
	public function stream_close(): void;

	/**
	 * @see https://www.php.net/streamwrapper.stream-eof
	 */
	public function stream_eof(): bool;

	/**
	 * @see https://www.php.net/streamwrapper.stream-flush
	 */
	public function stream_flush(): bool;

	/**
	 * @param self::LOCK_* $operation
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-lock.php
	 */
	public function stream_lock(int $operation): bool;

	/**
	 * @param int|string|array<int>                   $value
	 * @phpstan-param value-of<self::MetadataOptions> $option
	 *
	 * @see https://www.php.net/streamwrapper.stream-metadata
	 */
	public function stream_metadata(string $path, int $option, $value): bool;

	/**
	 * @phpstan-param value-of<self::OpensModes>      $mode
	 * @phpstan-param int-mask-of<self::OpensOptions> $options
	 *
	 * @see https://www.php.net/streamwrapper.stream-open
	 */
	public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool;

	/**
	 * @return string|false
	 *
	 * @see https://www.php.net/streamwrapper.stream-read
	 */
	public function stream_read(int $count);

	/**
	 * @phpstan-param value-of<self::SeeksWhence> $whence
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-seek.php
	 */
	public function stream_seek(int $offset, int $whence = SEEK_SET): bool;

	/**
	 * @phpstan-param value-of<self::SetOptionOptions> $option
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-set-option.php
	 */
	public function stream_set_option(int $option, int $arg1, int $arg2): bool;

	/**
	 * @return array<int|string, int>
	 *
	 * @see https://www.php.net/streamwrapper.stream-stat
	 */
	public function stream_stat(): array;

	/**
	 * @see https://www.php.net/streamwrapper.stream-tell
	 */
	public function stream_tell(): int;

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.stream-truncate.php
	 */
	public function stream_truncate(int $new_size): bool;

	/**
	 * @see https://www.php.net/streamwrapper.stream-write
	 */
	public function stream_write(string $data): int;

	/**
	 * @see https://www.php.net/manual/en/streamwrapper.unlink.php
	 */
	public function unlink(string $path): bool;

	/**
	 * @phpstan-param int-mask-of<self::UrlStatsFlags> $flags
	 * @return array<int|string, int>|false
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.url-stat.php
	 */
	public function url_stat(string $path, int $flags);

}
