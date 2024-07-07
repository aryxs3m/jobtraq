export type DetailFormatterFunction = (value: string|number|null) => string|null;

export class DetailFormatter {
  public static pieceFormatter(value: string|number|null) {
    return `${value} db`;
  }

  public static moneyFormatter(value: string|number|null) {
    if (value == null) {
      return null;
    }

    return value.toLocaleString('hu-HU', {
      style: 'decimal',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }) + ' Ft';
  }
}
