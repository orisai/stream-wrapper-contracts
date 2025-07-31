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
 * Interface for PHP's streamWrapper class prototype
 *
 * phpcs:disable Generic.NamingConventions.CamelCapsFunctionName.ScopeNotCamelCaps
 *
 * @phpstan-type T_Stat array{
 *      0: int,
 *      1: int,
 *      2: int,
 *      3: int,
 *      4: int,
 *      5: int,
 *      6: int,
 *      7: int,
 *      8: int,
 *      9: int,
 *      10: int,
 *      11: int,
 *      12: int,
 *      dev: int,
 *      ino: int,
 *      mode: int,
 *      nlink: int,
 *      uid: int,
 *      gid: int,
 *      rdev: int,
 *      size: int,
 *      atime: int,
 *      mtime: int,
 *      ctime: int,
 *      blksize: int,
 *      blocks: int,
 * }
 *
 * @see https://www.php.net/manual/en/streamwrapper
 * @see https://www.php.net/manual/en/stream.constants.php
 * @property resource|null $context Context autopopulated by PHP on function calls
 */
interface StreamWrapper
{

	public const StreamOpenFlags = [
		0,
		STREAM_USE_PATH,
		STREAM_REPORT_ERRORS,
	];

	public const StreamOpenModes = [
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

	public const StreamMetadataOptions = [
		STREAM_META_TOUCH,
		STREAM_META_OWNER_NAME,
		STREAM_META_OWNER,
		STREAM_META_GROUP_NAME,
		STREAM_META_GROUP,
		STREAM_META_ACCESS,
	];

	public const StreamCastOptions = [
		STREAM_CAST_AS_STREAM,
		STREAM_CAST_FOR_SELECT,
	];

	public const StreamLockOperations = [
		LOCK_SH,
		LOCK_EX,
		LOCK_UN,
		LOCK_NB,
	];

	public const StreamSeekWhence = [
		SEEK_SET,
		SEEK_CUR, // Never happens, internally converted to SEEK_SET
		SEEK_END,
	];

	public const StreamSetOptionOptions = [
		STREAM_OPTION_BLOCKING,
		STREAM_OPTION_READ_BUFFER,
		STREAM_OPTION_READ_TIMEOUT,
		STREAM_OPTION_WRITE_BUFFER,
	];

	public const UrlStatFlags = [
		0,
		STREAM_URL_STAT_LINK,
		STREAM_URL_STAT_QUIET,
	];

	public const MkdirRmdirFlags = [
		0,
		STREAM_MKDIR_RECURSIVE,
	];

	/**
	 * Close currently active directory handle, in response to closedir()
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.dir-closedir.php
	 */
	public function dir_closedir(): bool;

	/**
	 * Open directory handle, in response to opendir()
	 *
	 * @param int<0, 0> $options Not used since PHP 5.4
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.dir-opendir.php
	 */
	public function dir_opendir(string $path, int $options): bool;

	/**
	 * Read entry from directory handle, in response to readdir()
	 *
	 * @return string|false string representing next filename, false if there is no next file
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.dir-readdir.php
	 */
	public function dir_readdir();

	/**
	 * Rewind directory handle, in response to rewinddir()
	 * Re-reads the directory, any changes inside the directory that happened after first reading will manifest.
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.dir-rewinddir.php
	 */
	public function dir_rewinddir(): bool;

	/**
	 * Create a directory, in response to mkdir()
	 *
	 * @param int-mask-of<self::MkdirRmdirFlags> $options
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.mkdir.php
	 */
	public function mkdir(string $path, int $mode, int $options): bool;

	/**
	 * Rename file or directory, in response to rename()
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.rename.php
	 */
	public function rename(string $path_from, string $path_to): bool;

	/**
	 * Remove a directory, in response to rmdir()
	 *
	 * @param int-mask-of<self::MkdirRmdirFlags> $options
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.rmdir.php
	 */
	public function rmdir(string $path, int $options): bool;

	/**
	 * Retrieve the underlying resource, in response to stream_select()
	 *
	 * @param value-of<self::StreamCastOptions> $cast_as
	 * @return resource|false
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-cast
	 */
	public function stream_cast(int $cast_as);

	/**
	 * Close a resource, in response to fclose()
	 * All resources that were locked, or allocated, by the wrapper should be released.
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-close
	 */
	public function stream_close(): void;

	/**
	 * Tests for end-of-file on a file pointer, in response to feof()
	 *
	 * @return bool true if the read/write position is at the end of the stream and if no more data
	 *        is available to be read, or false otherwise.
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-eof
	 */
	public function stream_eof(): bool;

	/**
	 * Flushes the output, in response to fflush()
	 *
	 * @return bool true if data was successfully stored, there is no data to store or no underlying storage
	 *        false if the data could not be stored
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-flush
	 */
	public function stream_flush(): bool;

	/**
	 * Perform an operation with a file lock
	 *
	 * @param value-of<self::StreamLockOperations> $operation
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-lock.php
	 */
	public function stream_lock(int $operation): bool;

	/**
	 * Change stream metadata, in response to touch(), chmod(), chown() or chgrp()
	 *
	 * @param value-of<self::StreamMetadataOptions> $option
	 * @param int|string|array<int> $value
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-metadata
	 */
	public function stream_metadata(string $path, int $option, $value): bool;

	/**
	 * Open file or URL, in response to fopen(), file_get_contents(), etc.
	 *
	 * @param value-of<self::StreamOpenModes> $mode
	 * @param int-mask-of<self::StreamOpenFlags> $options
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-open.php
	 */
	public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool;

	/**
	 * Rad from stream, in response to fread() or fgets()
	 *
	 * @param int<1, max> $count
	 * @return string|false If there are less than *count* bytes available, as many as are available should be returned.
	 *        If no more data is available, an empty string should be returned.
	 *        To signal that reading failed, false should be returned.
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-read
	 */
	public function stream_read(int $count);

	/**
	 * Seek to specific location in a stream
	 *
	 * @param int<0, max> $offset
	 * @param value-of<self::StreamSeekWhence> $whence
	 * @return bool true if the position was updated, false otherwise
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-seek.php
	 */
	public function stream_seek(int $offset, int $whence = SEEK_SET): bool;

	/**
	 * Change stream options, in response to stream_set_* functions
	 *
	 * @param value-of<self::StreamSetOptionOptions> $option
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-set-option.php
	 */
	public function stream_set_option(int $option, int $arg1, int $arg2): bool;

	/**
	 * Retrieve information about a file source, in response to fstat()
	 *
	 * @return array<string, int>|false
	 * @phpstan-return T_Stat|false
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-stat
	 */
	public function stream_stat();

	/**
	 * Retrieve the current position of a stream, in response to fseek()
	 *
	 * @return int<0, max>
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-tell
	 */
	public function stream_tell(): int;

	/**
	 * Truncate stream, in response to ftruncate()
	 *
	 * @param int<0, max> $new_size
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-truncate.php
	 */
	public function stream_truncate(int $new_size): bool;

	/**
	 * Write to stream, in response to fwrite()
	 *
	 * @return int<0, max>
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.stream-write
	 */
	public function stream_write(string $data): int;

	/**
	 * Delete a file, in response to unlink()
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.unlink.php
	 */
	public function unlink(string $path): bool;

	/**
	 * Retrieve information about a file source, in response to stat() and all stat-related functions
	 *
	 * @param int-mask-of<self::UrlStatFlags> $flags
	 * @return array<string, int>|false
	 * @phpstan-return T_Stat|false
	 *
	 * @see https://www.php.net/manual/en/streamwrapper.url-stat.php
	 */
	public function url_stat(string $path, int $flags);

}
