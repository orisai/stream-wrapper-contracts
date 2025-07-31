# Stream Wrapper Contracts

Full and type-safe interface for PHP's [stream wrapper](https://www.php.net/manual/en/class.streamwrapper.php).

## Content

- [Setup](#setup)
- [Usage](#usage)

## Setup

Install with [Composer](https://getcomposer.org)

```sh
composer require orisai/stream-wrapper-contracts
```

## Usage

Implement `StreamWrapper` interface

```php
use Orisai\StreamWrapperContracts\StreamWrapper;

final class ExampleStreamWrapper implements StreamWrapper
{

	// ...

}
```
