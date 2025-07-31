<?php declare(strict_types = 1);

namespace Orisai\StreamWrapperContracts\Tests\Stubs;

use Orisai\StreamWrapperContracts\StreamWrapper;
use function fclose;
use function feof;
use function fflush;
use function fopen;
use function fread;
use function fseek;
use function fstat;
use function ftell;
use function ftruncate;
use function func_get_args;
use function fwrite;
use function is_resource;
use const SEEK_SET;

/**
 * phpcs:disable Generic.NamingConventions.CamelCapsFunctionName.ScopeNotCamelCaps
 */
final class StreamCallMonitor implements StreamWrapper
{

	/** @var resource|false */
	private $resource = false;

	/** @var resource|null */
	public $context;

	/** @var list<array<mixed>> */
	private static array $calls = [];

	/**
	 * @return list<array<mixed>>
	 */
	public static function flushCalls(): array
	{
		try {
			return self::$calls;
		} finally {
			self::$calls = [];
		}
	}

	public function dir_closedir(): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function dir_opendir(string $path, int $options): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function dir_readdir()
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function dir_rewinddir(): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function mkdir(string $path, int $mode, int $options): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function rename(string $path_from, string $path_to): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function rmdir(string $path, int $options): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function unlink(string $path): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function url_stat(string $path, int $flags)
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		$this->resource = fopen('php://temp', $mode);

		return is_resource($this->resource);
	}

	public function stream_read(int $count)
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? fread($this->resource, $count) : false;
	}

	public function stream_write(string $data): int
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? (int) fwrite($this->resource, $data) : 0;
	}

	public function stream_tell(): int
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? (int) ftell($this->resource) : 0;
	}

	public function stream_eof(): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? feof($this->resource) : true;
	}

	public function stream_flush(): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? fflush($this->resource) : false;
	}

	public function stream_seek(int $offset, int $whence = SEEK_SET): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) && fseek($this->resource, $offset, $whence) === 0;
	}

	public function stream_stat()
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		if (!is_resource($this->resource)) {
			return false;
		}

		return fstat($this->resource);
	}

	public function stream_truncate(int $new_size): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return is_resource($this->resource) ? ftruncate($this->resource, $new_size) : false;
	}

	public function stream_close(): void
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		if (is_resource($this->resource)) {
			fclose($this->resource);
		}
	}

	public function stream_cast(int $cast_as)
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function stream_lock(int $operation): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function stream_metadata(string $path, int $option, $value): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

	public function stream_set_option(int $option, int $arg1, int $arg2): bool
	{
		self::$calls[] = ['_' => __FUNCTION__] + func_get_args();

		return false;
	}

}
