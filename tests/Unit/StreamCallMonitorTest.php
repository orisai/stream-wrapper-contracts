<?php declare(strict_types = 1);

namespace Orisai\StreamWrapperContracts\Tests\Unit;

use Orisai\StreamWrapperContracts\Tests\Stubs\StreamCallMonitor;
use PHPUnit\Framework\TestCase;
use function fclose;
use function fopen;
use function fread;
use function fseek;
use function ftell;
use function fwrite;
use function rewind;
use function stream_get_contents;
use function stream_wrapper_register;
use function stream_wrapper_unregister;
use function strlen;

/**
 * @runTestsInSeparateProcesses
 */
final class StreamCallMonitorTest extends TestCase
{

	protected function setUp(): void
	{
		stream_wrapper_register('dummy', StreamCallMonitor::class);
	}

	protected function tearDown(): void
	{
		stream_wrapper_unregister('dummy');
	}

	public function testWriteAndRead(): void
	{
		$fp = fopen('dummy://file', 'w+b');
		self::assertIsResource($fp);

		$data = 'Hello StreamWrapper';
		self::assertSame(strlen($data), fwrite($fp, $data));

		rewind($fp);
		self::assertSame($data, stream_get_contents($fp));

		fclose($fp);
	}

	public function testSeekAndTell(): void
	{
		$fp = fopen('dummy://seek', 'w+b');
		self::assertNotFalse($fp);
		fwrite($fp, 'abcdef');

		self::assertSame(fseek($fp, 2), 0);
		self::assertSame(2, ftell($fp));
		self::assertSame('c', fread($fp, 1));

		fclose($fp);
	}

}
